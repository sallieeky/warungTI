<?php

namespace App\Http\Domains\Inventories\Services;

use App\Http\Domains\Inventories\Model\Inventory;
use App\Http\Domains\Shared\ResponseService;
class GetInventoryService
{
    public function index()
    {
        $inventories = Inventory::all();
        return ResponseService::success($inventories);
    }
}
