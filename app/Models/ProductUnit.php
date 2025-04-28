<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductUnit extends Model
{
    protected $table = 'product_unit_conversions';
    protected $guarded = [];

    public function unit() : BelongsTo
    {
        return $this->belongsTo(Unit::class,  'product_unit_id', 'id');
    }
    public function price() : HasOne
    {
        return $this->HasOne(ProductPrice::class,  'product_unit_conversion_id', 'id');
    }
}
