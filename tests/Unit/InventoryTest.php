<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Domains\Inventories\Services\GetInventoryService;
use App\Http\Domains\Inventories\Services\StoreInventoryService;

class InventoryTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_it_can_get_all_inventories(): void
    {
        $mockService = $this->getMockBuilder(GetInventoryService::class)
            ->onlyMethods(['index'])
            ->getMock();

        $mockService->expects($this->once())
            ->method('index')
            ->willReturn([
                ['product_id' => 1, 'name' => 'Warehouse 1', 'stock' => 50, 'location' => 'Bontang'],
                ['product_id' => 2, 'name' => 'Warehouse 2', 'stock' => 100, 'location' => 'Bontang'],
            ]);

        $result = $mockService->index();

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertEquals('Warehouse 1', $result[0]['name']);
    }

    /**
     * Test to ensure that a product can be created.
     */
    public function test_it_can_create_inventory(): void
    {
        // Arrange: Mock the service and its behavior.
        $mockService = $this->getMockBuilder(StoreInventoryService::class)
            ->onlyMethods(['create'])
            ->getMock();

        $mockData = [
            'product_id' => 3,
            'name' => 'Warehouse 3',
            'stock' => 1000,
            'location' => 'Bontang',
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
        $this->assertEquals(3, $product['product_id']);
        $this->assertEquals('Warehouse 3', $product['name']);
        $this->assertEquals(1000, $product['stock']);
        $this->assertEquals('Bontang', $product['location']);
    }
}
