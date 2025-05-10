<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestOrderDeliveryItem extends Model
{
    protected $table = "request_order_delivery_items";
    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }   

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_requested_id', 'id');
    }   

    public function requestOrder(): BelongsTo
    {
        return $this->belongsTo(requestOrder::class);
    }   

    public function requestOrderItems(): BelongsTo
    {
        return $this->belongsTo(requestOrderItem::class);
    }   
}
