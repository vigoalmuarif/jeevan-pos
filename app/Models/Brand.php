<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'product_brands';
    protected $guarded = [];

    protected function name(): Attribute
    {
        return Attribute::make(
            // get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => str()->title($value),
        );
    }

    protected function brandCode(): Attribute
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
