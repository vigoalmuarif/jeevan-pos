<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductCategory extends Model
{
    protected $table = 'product_category';

    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_category', 'product_id', 'product_category_id');
    }
}
