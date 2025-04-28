<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $table = 'product_categories';

    protected $fillable = [
        'name',
        'business_id',
        'category_code',
        'status',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            // get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => str()->title($value),
        );
    }
    protected function categoryCode(): Attribute
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

    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_category', 'product_category_id', 'product_id');
    }
}
