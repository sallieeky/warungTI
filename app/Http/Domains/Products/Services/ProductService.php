<?php

namespace App\Http\Domains\Products\Services;
use App\Http\Domains\Products\Models\Product;

class ProductService
{
    public function create($data)
    {
        return Product::create([
            'id' => $data->id,
            'name' => $data->name,
            'price' => $data->price,
        ]);
    }
}
