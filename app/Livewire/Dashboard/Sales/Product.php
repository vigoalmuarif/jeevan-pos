<?php

namespace App\Livewire\Dashboard\Sales;

use App\Models\Category;
use App\Models\Product as ModelsProduct;
use App\Models\Unit;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Product extends Component
{

    public $products = [];
    public $categories = [];
    public $perPage = 15;
    public $units = [];
    public $prices = [];
    public $quantities = [];
    public $setCategory;
    public $search;

    public function mount()
    {
        $this->products();
        $this->categories();
    }

    public function products()
    {
        $this->products = ModelsProduct::with([
            'prices.unit',
            'prices.conversion',
            'product_unit_conversions' => function ($q) {
                $q->orderBy('conversion_factor', 'asc');
            },
            'prices' => function ($q) {
                $q->where('status', 1)
                    ->where('warehouse_id', 2)
                    ->select('product_id', 'selling_price', 'cost_price', 'warehouse_id', 'product_unit_id');
            }
        ])
            ->whereHas('alocations', function ($q) { 
                return $q->where('location_id', 2);
            })
            ->whereHas('categories', function ($q)  {
                return $q->where('product_category_id', 'ilike', '%'. $this->setCategory .'%');
            })
            ->where('name', 'ilike', '%' . $this->search . '%')
            ->limit($this->perPage)
            ->get();

        // Set satuan default ke yang terkecil
        foreach ($this->products as $product) {
            $this->units[$product->id] = $product->product_unit_conversions->first()->pivot->product_unit_id;
            $this->prices[$product->id]= $product->prices->firstWhere('product_unit_id', $this->units[$product->id])->cost_price ?? 0;
            $this->quantities[$product->id] = 1;
        }
    }

    public function categories()
    {
        $this->categories = Category::withCount('products')->where('status', 1)->get();

    }

    public function selectedCategory($categoryID = null)
    {
        $this->setCategory = $categoryID;
        $this->productsByCategory($categoryID);
        $this->categories();
    }

    public function productsByCategory($categoryID = null)
    {
        $this->products = ModelsProduct::with([
            'prices.unit',
            'prices.conversion',
            'product_unit_conversions' => function ($q) {
                $q->orderBy('conversion_factor', 'asc');
            },
            'prices' => function ($q) {
                $q->where('status', 1)
                    ->where('warehouse_id', 2)
                    ->select('product_id', 'selling_price', 'cost_price', 'warehouse_id', 'product_unit_id');
            }
        ])
            ->whereHas('alocations', function ($q) {
                return $q->where('location_id', 2);
            })
            ->whereHas('categories', function ($q) use($categoryID) {
                return $q->where('product_category_id', 'ilike', '%'. $categoryID .'%');
            })
            ->where('name', 'ilike', '%' . $this->search . '%')
            ->limit($this->perPage)
            ->get();

        // Set satuan default ke yang terkecil
        foreach ($this->products as $product) {
            $this->units[$product->id] = $product->product_unit_conversions->first()->pivot->product_unit_id;
            $this->prices[$product->id]= $product->prices->firstWhere('product_unit_id', $this->units[$product->id])->cost_price ?? 0;
            $this->quantities[$product->id] = 1;
        }
    }

    public function updatedSearch()
    {
        $this->products();
        $this->categories();
    }

    public function selectedSatuan($productID = null,  $satuanID = null)
    {
        $product = ModelsProduct::find($productID);
        if($product){
            unset($this->units[$productID]);
            unset($this->quantities[$productID]);
            $this->units[$productID] = $satuanID;
            $this->prices[$productID] = $product->prices->firstWhere('product_unit_id', $satuanID)->cost_price ?? 0;
            $this->quantities[$productID] = 1;
        }
        $this->categories();
    }

    public function descreaseQty($productID)
    {
        if($this->quantities[$productID] > 1){
            $this->quantities[$productID] -= 1;
        }
    }
    public function increaseQty($productID)
    {
        $this->quantities[$productID] += 1;
    }

    public function updateQty($productID, $value)
    {
        $this->quantities[$productID] = max(1, (int) $value);
    }

    public function addToCart($productID = null)
    {
        $product = ModelsProduct::where('id', $productID)->select('id', 'name', 'profile_product_filename')->first();
        $price = $product->prices()->firstWhere('product_unit_id', $this->units[$product->id])->cost_price;

        if ($productID != null && $product) {
            if($price == 0 || $price == null){
                Toaster::warning('Harga jual produk belum diset!');
                return false;
            }elseif($this->units[$product->id] == null){
                Toaster::warning('Harap masukan quantity produk');
                return false;
            }
            else{
                $cart =  [
                    'product' => $product,
                    'satuan' => Unit::find($this->units[$product->id]),
                    'qty' => $this->quantities[$product->id],
                    'price' => $price
                ];
                $this->dispatch('add-to-cart', product: $cart);
            }
        }else{
            Toaster::error('Produk tidak valid');
        }
        $this->categories();
    }

    public function render()
    {
        return view('livewire.dashboard.sales.product');
    }
}
