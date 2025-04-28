<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $guarded = [];

    protected function supplierCode(): Attribute
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
