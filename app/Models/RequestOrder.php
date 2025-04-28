<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RequestOrder extends Model
{
    protected $table = 'request_orders';
    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function from_warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouses::class, 'from_warehouse_id', 'id');
    }
    public function to_warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouses::class, 'to_warehouse_id', 'id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'request_by', 'id');
    }
    public function items(): HasMany
    {
        return $this->hasMany(RequestOrderitem::class);
    }

    
}
