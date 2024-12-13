<?php

namespace App\Http\Domains\Products\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'sku', 'price', 'published_at'];
}