<?php

namespace App\Http\Domains\Products\Services;
use App\Http\Domains\Products\Model\Product;

class ProductService
{
    public static function get() {
        return Product::all();
    }

    public static function create($data)
    {
        return Product::create([
            'name' => $data->name,
            'sku' => $data->sku,
            'price' => $data->price,
            'published_at' => $data->published_at,
        ]);
    }
}
