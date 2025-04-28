<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleCart extends Model
{
    protected $table ='sale_carts';
    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function price(): BelongsTo
    {
        return $this->belongsTo(ProductPrice::class, 'product_price_id', 'id');
    }
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'product_unit_id', 'id');
    }
}
