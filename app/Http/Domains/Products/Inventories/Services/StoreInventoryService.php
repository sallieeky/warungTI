<?php

namespace App\Http\Domains\Inventories\Services;

use App\Events\ProductAdded;
use App\Http\Domains\Inventories\Model\Inventory;
use App\Http\Domains\Inventories\Request\StoreInventoryRequest;
use App\Http\Domains\Shared\ResponseService;
use Illuminate\Support\Facades\Validator;

class StoreInventoryService
{
    public function validate($data) {
        $validator = Validator::make($data, (new StoreInventoryRequest())->rules());

        $errors = collect();
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $errors->push($error);
            }
            $errorAsString = $errors->implode(', ');
            return ResponseService::error($errorAsString);
        }

        return ResponseService::success([]);
    } 

    public function create($data)
    {
        $validated = $this->validate($data);
        if($validated['status'] == 'error') {
            return ResponseService::error($validated['message']);
        }

        $product = Inventory::create([
            'product_id' => $data['product_id'],
            'name' => $data['name'],
            'stock' => $data['stock'],
            'location' => $data['location'],
        ]);

        return ResponseService::success($product);
    }
}
