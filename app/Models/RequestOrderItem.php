<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestOrderItem extends Model
{
    protected $table = 'request_order_items';
    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'product_unit_id', 'id');
    }
    public function unitSourceWarehouse(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'product_unit_warehouse_id', 'id');
    }

    public function unitDestinationWarehouse(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'product_unit_destination_id', 'id');
    }

    public function unitApproved(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'product_unit_approved_id', 'id');
    }
}
