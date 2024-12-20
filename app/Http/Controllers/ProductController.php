<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Domains\Products\Services\StoreProductService;
use App\Http\Domains\Products\Services\GetProductService;

class ProductController extends Controller
{
    protected $getProductService;
    protected $storeProductService;
    
    public function __construct(GetProductService $getProductService, StoreProductService $storeProductService)
    {
        $this->getProductService = $getProductService;
        $this->storeProductService = $storeProductService;
    }
    
    public function index()
    {
        return $this->getProductService->index();
    }
    
    public function store(Request $request)
    {
        $response = $this->storeProductService->create($request->all());
        return response()->json($response, $response['status'] === 'success' ? 201 : 400);
    }
}