<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleItem extends Model
{
    protected $table = 'sale_items';
    protected $guarded = [];

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function unit():BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}
