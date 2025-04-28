<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    protected $guarded = [];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouses::class, 'warehouse_id', 'id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function base_unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'base_unit_id', 'id');
    }
    public function base_warehouse_unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'base_warehouse_unit_id', 'id');
    }
    public function images(): MorphMany
    {
        return $this->morphMany(ProductImage::class, 'imageable')->chaperone();
    }

    public function product_unit_conversions(): BelongsToMany
    {
        return $this->belongsToMany(Unit::class, 'product_unit_conversions', 'product_id', 'product_unit_id')
            ->withPivot('product_unit_id', 'conversion_factor');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'product_category_id')->withPivot('product_category_id'); ;
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'product_brand_id', 'id');
    }

    public function prices(): HasMany
    {
        return $this->HasMany(ProductPrice::class);
    }

    public function alocations(): HasMany
    {
        return $this->HasMany(StockAlocation::class);
    }
}
