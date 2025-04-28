<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPrice extends Model
{
    protected $table = 'product_prices';
    protected $guarded = [];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'product_unit_id', 'id');
    }
    public function conversion(): BelongsTo
    {
        return $this->belongsTo(ProductUnit::class, 'product_unit_conversion_id', 'id');
    }

    public function alocation(): BelongsTo
    {
        return $this->belongsTo(StockAlocation::class, 'warehouse_id', 'location_id');
    }
}
