<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Unit extends Model
{
    protected $table = 'product_units';

    protected $guarded = [];

    protected function name(): Attribute
    {
        return Attribute::make(
            // get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => str()->title($value),
        );
    }
    protected function status(): Attribute
    {
        return Attribute::make(
            // get: fn (string $value) => ucfirst($value),
            get: fn (string $value) => $value == 1 ? 'Active' : 'Inactive',
        );
    }

      public function products(): BelongsToMany
    {
        return $this->belongsToMany(Unit::class, 'product_unit_conversions', 'product_unit_id', 'product_id')
            ->withPivot('product_unit_id', 'conversion_factor');
    }
}
