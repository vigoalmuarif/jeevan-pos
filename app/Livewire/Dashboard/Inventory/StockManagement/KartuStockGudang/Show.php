<?php

namespace App\Livewire\Dashboard\Inventory\StockManagement\KartuStockGudang;

use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\StockAlocation;
use App\Models\StockCard;
use App\Models\Warehouses;
use Livewire\Component;

class Show extends Component
{
    public $slug;
    public $warehouse;
    public $product;
    public $data_warehouse;
    public $search;
    public $perPage = 10;

    public function mount()
    {
        $warehouse = Warehouses::where('business_id', auth()->user()->current_active_business_id)
            ->where('slug', $this->warehouse)
            ->first();

        $this->data_warehouse = $warehouse;


        $product = StockAlocation::with(['product.product_unit_conversions' => function ($q) {
            $q->orderBy('conversion_factor', 'asc');
        }])
            ->whereHas('product', function ($q) use ($warehouse) {
                return $q->where('slug', $this->slug)
                    ->where('business_id', auth()->user()->current_active_business_id);
            })
            ->join('product_unit_conversions', function ($join) {
                $join->on('stock_alocations.product_unit_id', 'product_unit_conversions.product_unit_id')
                    ->on('stock_alocations.product_id', 'product_unit_conversions.product_id');
            })
            ->distinct()
            ->where('location_id', $warehouse->id)
            ->first();


        $this->product = $product;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $stock_cards = StockCard::with(['batch', 'user', 'unit', 'referenceable'])
            ->where('product_id', $this->product->product_id)
            ->where('warehouse_id', $this->data_warehouse->id)
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);

        return view('livewire.dashboard.inventory.stock-management.kartu-stock-gudang.show', [
            'stock_cards' => $stock_cards
        ]);
    }
}
