<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Http\Domains\Inventories\Model\Inventory;
use App\Http\Domains\Inventories\Services\SubtractStockInventoryService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AdjustStock
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;
        $subtractStockInventoryService = new SubtractStockInventoryService();
        $subtractStockInventoryService->execute($order);
    }
}
