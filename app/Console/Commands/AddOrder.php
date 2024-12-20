<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Domains\Orders\Services\StoreOrderService;

class AddOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:add {order_date} {total_amount} {product_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new order to the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(StoreOrderService $orderService)
    {
        // Gather arguments from the command
        $data = [
            'order_date' => $this->argument('order_date'),
            'total_amount' => $this->argument('total_amount'),
            'product_id' => $this->argument('product_id')
        ];

        // Validate the data using the rules from StoreOrderService
        
        try {
            // Pass validated data to ProductService
            $createOrder = $orderService->create($data);
            if($createOrder['status'] == 'success') 
                return $this->info('Order added successfully.');
            if($createOrder['status'] == 'error') 
                return $this->error('Error: ' . $createOrder['message']);
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
