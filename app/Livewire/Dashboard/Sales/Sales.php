<?php

namespace App\Livewire\Dashboard\Sales;

use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.sales')]
class Sales extends Component
{

    public $carts = [];
 

    public function addToCart($productID = null, $satuanID = null, $quantity = null, $price = null)
    {
        dd($quantity);
        if ($productID != null && $satuanID != null && ($quantity != null || $quantity > 0) && ($price != null || (int) $price > 0)) {
            $this->carts[] =  [
                'product' => Product::where('id', $productID)->first(),
                'satuan' => Unit::find($satuanID),
                'qty' => $quantity,
                'price' => $price
            ];
        }

        $this->loadProducts();
    }

    // public function loadProducts()
    // {
    //     $this->products = Product::with([
    //         'prices.unit',
    //         'prices.conversion',
    //         'product_unit_conversions' => function ($q) {
    //             $q->orderBy('conversion_factor', 'asc');
    //         },
    //         'prices' => function ($q) {
    //             $q->where('status', 1)
    //                 ->where('warehouse_id', 2)
    //                 ->select('product_id', 'selling_price', 'cost_price', 'warehouse_id', 'product_unit_id');
    //         }
    //     ])
    //         ->whereHas('alocations', function ($q) {
    //             return $q->where('location_id', 2);
    //         })
    //         ->limit($this->perPage)
    //         ->get();

    //     // Set satuan default ke yang terkecil
    //     foreach ($this->products as $product) {
    //         $product->selected_unit = $product->product_unit_conversions->first();
    //         $this->prices[$product->id] = $product->prices->where('product_unit_id', $product->selected_unit->pivot->product_unit_id)->first();
    //         $product->quantity = 1;
    //     }
    // }

    public function render()
    {
        return view('livewire.dashboard.sales.sales');
    }
}
