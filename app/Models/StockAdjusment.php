<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockAdjusment extends Model
{
    protected $table = 'stock_adjustments';
    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouses::class);
    }
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'product_unit_id', 'id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'adjustment_by', 'id');
    }
}
