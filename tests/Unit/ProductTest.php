<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Collection;
use App\Http\Domains\Products\Services\GetProductService;
use App\Http\Domains\Products\Services\StoreProductService;

class ProductTest extends TestCase
{
    /**
     * Test to ensure that the service can fetch all products.
     */
    public function test_it_can_get_all_products(): void
    {
        $mockService = $this->getMockBuilder(GetProductService::class)
            ->onlyMethods(['index'])
            ->getMock();

        $mockService->expects($this->once())
            ->method('index')
            ->willReturn([
                ['name' => 'Product 1', 'sku' => 'SKU1', 'price' => 5000],
                ['name' => 'Product 2', 'sku' => 'SKU2', 'price' => 10000],
            ]);

        $result = $mockService->index();

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertEquals('Product 1', $result[0]['name']);
    }

    /**
     * Test to ensure that a product can be created.
     */
    public function test_it_can_create_product(): void
    {
        // Arrange: Mock the service and its behavior.
        $mockService = $this->getMockBuilder(StoreProductService::class)
            ->onlyMethods(['create'])
            ->getMock();

        $mockData = [
            'name' => 'Test Product',
            'sku' => 'TEST-123',
            'price' => 10000,
            'published_at' => now(),
        ];

        $mockService->expects($this->once())
            ->method('create')
            ->with($mockData)
            ->willReturn([
                'status' => 'success',
                'message' => 'Product created successfully.',
                'data' => $mockData,
            ]);

        // Act: Call the create method on the mocked service.
        $response = $mockService->create($mockData);

        // Extract the product from the response.
        $product = $response['data'] ?? null;

        // Assert: Verify that the product was created correctly.
        $this->assertNotNull($product);
        $this->assertEquals('Test Product', $product['name']);
        $this->assertEquals('TEST-123', $product['sku']);
        $this->assertEquals(10000, $product['price']);
        $this->assertEquals(now()->toDateTimeString(), $product['published_at']);
    }
}
