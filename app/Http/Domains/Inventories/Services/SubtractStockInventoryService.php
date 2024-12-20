<?php

namespace App\Http\Domains\Inventories\Services;

use App\Http\Domains\Inventories\Model\Inventory;
use App\Http\Domains\Shared\ResponseService;

class SubtractStockInventoryService
{
    public function execute($order)
    {
        $product_id = $order->product_id;
        $inventory = Inventory::where('stock', '>', $order->total_amount)->where('product_id', $product_id)->first();
        if(!$inventory) {
            throw new \Exception('Inventory not found');
        }

        if($inventory->stock == 0) {
            throw new \Exception('Inventory out of stock');
        }

        $inventory_id = $inventory->id;
        $inventory_stock = $inventory->stock;
        Inventory::where('id', $inventory_id)
            ->update(  [
                'stock' => $inventory_stock - 1
            ]);
        $inventory = Inventory::find($inventory_id);

        return ResponseService::success($inventory);
    }
}