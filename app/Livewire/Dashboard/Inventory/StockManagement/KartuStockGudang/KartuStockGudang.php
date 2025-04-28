<?php

namespace App\Livewire\Dashboard\Inventory\StockManagement\KartuStockGudang;

use App\Models\StockAlocation;
use App\Models\Warehouses;
use Livewire\Component;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class KartuStockGudang extends Component
{
    public $warehouse_filter;
    public $stock_filter = 1;
    public $search;
    public $perPage = 10;
    public function render()
    {
        $warehouses = Warehouses::where('business_id', auth()->user()->current_active_business_id)->get();
        $products = StockAlocation::select('stock_alocations.product_id', 'stock_alocations.location_id', 'stock_alocations.quantity', 'conversion.conversion_factor', 'product_units.name as satuan')
            ->with(['product:id,sku,name,slug,base_unit_id', 'unit:id,name', 'warehouse:id,name,slug', 'product.product_unit_conversions' => function($q){
                $q->distinct()->orderBy('conversion_factor', 'asc');
            }])
            ->whereHas('product', function (Builder $q) {
                $q->where('name', 'ilike', '%' . $this->search . '%');
            })
            ->join(DB::raw('(
                SELECT DISTINCT ON (product_id, product_unit_id) *
                FROM product_unit_conversions
                ORDER BY product_id, product_unit_id, id ASC
            ) as conversion'), function ($join) {
                $join->on('stock_alocations.product_id', '=', 'conversion.product_id')
                    ->on('stock_alocations.product_unit_id', '=', 'conversion.product_unit_id');
            })
            ->join('product_units', function ($join) {
                $join->on('product_units.id', 'conversion.product_unit_id');
            })
            ->where('location_id',  $this->warehouse_filter)
            ->when($this->stock_filter != 1, function ($q) {
                if ($this->stock_filter == 2) {
                    return $q->where('quantity', '>', 0);
                } elseif ($this->stock_filter == 3) {
                    return $q->where('quantity', '=', 0);
                } else {
                    return $q->where('quantity', '<', 0);
                }
            })
            ->paginate($this->perPage);

        // dd($products);

        return view('livewire.dashboard.inventory.stock-management.kartu-stock-gudang.kartu-stock-gudang', [
            'warehouses' => $warehouses,
            'products' => $products
        ]);
    }
}
