<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
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
    public function handle()
    {
        $name = $this->argument('name');
        $sku = $this->argument('sku');
        $price = $this->argument('price');
        $published_at = $this->argument('published_at');

        try {
            ProductService::create((object)[
                'name' => $name,
                'sku' => $sku,
                'price' => $price,
                'published_at' => $published_at,
            ]);

            $this->info('Product added successfully.');
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }

        return 0;
    }
}
