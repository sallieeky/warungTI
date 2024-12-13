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
            'id' => $data->id,
            'name' => $data->name,
            'price' => $data->price,
        ]);
    }
}
