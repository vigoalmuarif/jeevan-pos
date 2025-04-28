<?php

namespace App\Livewire\Dashboard\Inventory\StockManagement\KartuStockProduk;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class KartuStockProduk extends Component
{
    public function render()
    {
        $stocks = DB::raw("
            WITH unit_conversions AS(
                SELECT
                    stock_alocations.product_unit_id as unit_conversion,
                    product_unit_conversions.conversion_factor,
                    stock_alocations.product_id,
                    stock_alocations.location_id as location,
                FROM 
                    stock_alocations
                LEFT JOIN product_unit_conversions

            )
        ");
        return view('livewire.dashboard.inventory.stock-management.kartu-stock-produk.kartu-stock-produk');
    }
}
