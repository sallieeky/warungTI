<?php

namespace App\Http\Domains\Inventories\Services;

use App\Http\Domains\Inventories\Model\Inventory;
use App\Http\Domains\Shared\ResponseService;

class SubtractStockInventoryService
{
    public function execute($product_id)
    {
        $inventory = Inventory::where('stock', '>', '0')->where('product_id', $product_id)->first();
        if(!$inventory) {
            return ResponseService::error('Inventory not found');
        }

        if($inventory->stock == 0) {
            return ResponseService::error('Product out of stock');
        }

        $inventory_id = $inventory->id;
        $inventory_stock = $inventory->stock;
        Inventory::where('id', $inventory_id)
            ->update( attributes: [
                'stock' => $inventory_stock - 1
            ]);
        $inventory = Inventory::find($inventory_id);

        return ResponseService::success($inventory);
    }
}