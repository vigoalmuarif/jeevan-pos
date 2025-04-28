<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouses extends Model
{
    
    protected $table = 'warehouses';
    protected $guarded = [];

    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Warehouses::class, 'branch_warehouses', 'warehouse_id', 'branch_id')->withPivot(['status', 'id']);
    }
    public function users(): HasMany
    {
        return $this->HasMany(User::class, 'branch_id', 'id');
    }

    public function ppic(): BelongsTo   
    {
        return $this->BelongsTo(User::class, 'ppic_id', 'id');
    }

    public function purchases(): HasMany
    {
        return $this->HasMany(Purchase::class);
    }

    public function stock_batches(): HasMany
    {
        return $this->HasMany(StockBatch::class);
    }

    public function product_prices(): HasMany
    {
        return $this->HasMany(ProductPrice::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            // get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => str()->title($value),
        );
    }
    protected function warehouseCode(): Attribute
    {
        return Attribute::make(
            // get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => str()->upper($value),
        );
    }
    protected function status(): Attribute
    {
        return Attribute::make(
            // get: fn (string $value) => ucfirst($value),
            get: fn (string $value) => $value == 1 ? 'Active' : 'Inactive',
        );
    }
}
