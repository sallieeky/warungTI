<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Domains\Products\Services\ProductService;

class AddProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:add {name} {sku} {price} {published_at?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new product to the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ProductService $productService)
    {
        // Gather arguments from the command
        $data = [
            'name' => $this->argument('name'),
            'sku' => $this->argument('sku'),
            'price' => $this->argument('price'),
            'published_at' => $this->argument('published_at'),
        ];

        // Validate the data using the rules from StoreProductRequest
        

        try {
            // Pass validated data to ProductService
            $createProduct = $productService->create($data);
            if($createProduct['status'] == 'success') 
                return $this->info('Product added successfully.');
            if($createProduct['status'] == 'error') 
                return $this->error('Error: ' . $createProduct['message']);
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
