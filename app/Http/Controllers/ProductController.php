<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Domains\Shared\JSONResponseService;

use App\Http\Domains\Products\Services\ProductService;

class ProductController extends Controller
{
    public function index() {
        $response = JSONResponseService::success(ProductService::get());
        return $response;
    }
}
