<?php

namespace App\Livewire\Dashboard\Inventory\StockManagement\StockAdjustment;

use App\Models\StockAdjusment;
use App\Models\Warehouses;
use Livewire\Component;
use Livewire\WithPagination;

class StockAdjustment extends Component
{
    use WithPagination;
    public $search;
    public $start_date;
    public $end_date;
    public $warehouse_id;
    public $perPage = 10;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $stock_adjustments = StockAdjusment::with(['warehouse', 'product'])
            ->whereHas('product', function($q){
                $q->where(function ($w) {
                    $w->where('name', 'ilike', '%' . $this->search . '%')
                        ->orWhere('sku', 'ilike', '%' . $this->search . '%');
                });
            })
            ->where('warehouse_id', $this->warehouse_id)
            ->when($this->start_date, function($when){
                $when->whereDate('created_at', '>=', $this->start_date);

            })
            ->when($this->end_date, function($when){
                $when->whereDate('created_at', '<=', $this->end_date);

            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        $warehouses = Warehouses::where('business_id', auth()->user()->current_active_business_id)
            ->where('status', 1)
            ->get();

        return view('livewire.dashboard.inventory.stock-management.stock-adjustment.stock-adjustment', [
            'stock_adjustments' => $stock_adjustments,
            'warehouses' => $warehouses
        ]);
    }
}
