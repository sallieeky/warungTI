<?php

namespace App\Http\Domains\Products\Services;
use App\Http\Domains\Products\Model\Product;
use App\Http\Domains\Shared\ResponseService;

class GetProductService
{
    public function index()
    {
        $products = Product::all();
        return ResponseService::success($products);
    }
}
