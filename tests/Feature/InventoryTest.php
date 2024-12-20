<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InventoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_it_can_get_all_inventories(): void
    {
        $result = app(\App\Http\Domains\Inventories\Services\GetInventoryService::class)->index();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function test_it_can_create_inventory(): void
    {
        $data = [
            'product_id' => 1,
            'name' => "Warehouse 2",
            'stock' => 100,
            'location' => "Bontang"
        ];
        
        $service = app(\App\Http\Domains\Inventories\Services\StoreInventoryService::class);
        $response = $service->create($data);

        $inventory = $response['data'] ?? null;

        $this->assertNotNull($inventory);
        $this->assertEquals(1, $inventory->product_id);
        $this->assertEquals('Warehouse 2', $inventory->name);
        $this->assertEquals(100, $inventory->stock);
        $this->assertEquals('Bontang', $inventory->location);
    }
}
