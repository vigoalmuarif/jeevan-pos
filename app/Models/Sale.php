<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Sale extends Model
{
    protected $guarded = [];

    public function stock_cards(): MorphMany
    {
        return $this->morphMany(StockCard::class, 'referenceable');
    }
    public static function generateOrderNumber()
    {
        $date = date('ymd'); // Format Tanggal: 250329
        $lastOrder = self::whereDate('created_at', now())->latest()->first();
        $orderNumber = $lastOrder ? intval(substr($lastOrder->no_transaction, -5)) + 1 : 1;
        return 'INV' . $date . '' . str_pad($orderNumber, 5, '0', STR_PAD_LEFT);
    }

    public function branch():BelongsTo
    {
        return $this->belongsTo(Warehouses::class, 'branch_id', 'id');
    }
    public function items():HasMany
    {
        return $this->hasMany(SaleItem::class, 'sale_id', 'id');
    }
    public function payments():HasMany
    {
        return $this->hasMany(SalePayment::class, 'sale_id', 'id');
    }
    public function cashier():BelongsTo
    {
        return $this->belongsTo(User::class, 'cashier_id', 'id');
    }
}
