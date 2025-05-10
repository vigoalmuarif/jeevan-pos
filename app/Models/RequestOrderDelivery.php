<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestOrderDelivery extends Model
{
    protected $table = 'request_order_deliveries';
    protected $guarded = [];

    public function requestOrder(): BelongsTo
    {
        return $this->belongsTo(requestOrder::class);
    } 
    public function user(): BelongsTo
    {
        return $this->belongsTo(user::class, 'user_delivery', 'id');
    } 
}
