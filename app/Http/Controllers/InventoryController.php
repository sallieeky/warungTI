<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Domains\Inventories\Services\StoreInventoryService;
use App\Http\Domains\Inventories\Services\GetInventoryService;

class InventoryController extends Controller
{
    protected $storeInventoryService;
    protected $getInventoryService;
    
    public function __construct(StoreInventoryService $storeInventoryService, GetInventoryService $getInventoryService)
    {
        $this->getInventoryService = $getInventoryService;
        $this->storeInventoryService = $storeInventoryService;
    }

    public function index()
    {
        return $this->getInventoryService->index();
    }
    
    public function store(Request $request)
    {
        $response = $this->storeInventoryService->create($request->all());
        return response()->json($response, $response['status'] === 'success' ? 201 : 400);
    }
}
