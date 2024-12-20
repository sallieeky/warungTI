<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Domains\Inventories\Services\StoreInventoryService;

class AddInventory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inventory:add {product_id} {name} {stock} {location}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new inventory to the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(StoreInventoryService $inventoryService)
    {
        // Gather arguments from the command
        $data = [
            'product_id' => $this->argument('product_id'),
            'name' => $this->argument('name'),
            'stock' => $this->argument('stock'),
            'location' => $this->argument('location'),
        ];

        // Validate the data using the rules from StoreInventoryService
        
        try {
            // Pass validated data to ProductService
            $createInventory = $inventoryService->create($data);
            if($createInventory['status'] == 'success') 
                return $this->info('Inventory added successfully.');
            if($createInventory['status'] == 'error') 
                return $this->error('Error: ' . $createInventory['message']);
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
