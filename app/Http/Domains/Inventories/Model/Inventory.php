<?php

namespace App\Http\Domains\Inventories\Model;

use App\Http\Domains\Products\Model\Product;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'stock',
        'location',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
