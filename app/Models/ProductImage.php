<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $guarded = [];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
