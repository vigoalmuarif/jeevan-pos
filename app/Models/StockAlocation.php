<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockAlocation extends Model
{
    protected $table = 'stock_alocations';
    protected $guarded = [];

    // protected function status(): Attribute
    // {
    //     return Attribute::make(
    //         // get: fn (string $value) => ucfirst($value),
    //         get: fn (string $value) => match($value) {
    //             '1' => 'Aktif Unit',
    //             '2' => 'Aktif Penjualan',
    //             '3' => 'Aktif Unit & Aktif Penjualan',
    //             '0' => 'Tidak Aktif',
    //         }
    //     );
    // }

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function warehouse() : BelongsTo
    {
        return $this->belongsTo(Warehouses::class, 'location_id', 'id');
    }
    public function unit() : BelongsTo
    {
        return $this->belongsTo(Unit::class, 'product_unit_id', 'id');
    }
   
}
