<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_it_can_get_all_products(): void
    {
        $result = app(\App\Http\Domains\Products\Services\GetProductService::class)->index();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_it_can_create_product(): void
    {
        $data = [
            'name' => 'Test Product',
            'sku' => 'TEST-123',
            'price' => 10000,
            'published_at' => now(),
        ];
        
        $service = app(\App\Http\Domains\Products\Services\StoreProductService::class);
        $response = $service->create($data);

        $product = $response['data'] ?? null;

        $this->assertNotNull($product);
        $this->assertEquals('Test Product', $product->name);
        $this->assertEquals('TEST-123', $product->sku);
        $this->assertEquals(10000, $product->price);
        $this->assertEquals(now()->toDateString(), $product->published_at->toDateString());
    }
}
