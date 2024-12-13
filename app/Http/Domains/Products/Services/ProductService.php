<?php

namespace App\Http\Domains\Products\Services;
use App\Http\Domains\Products\Model\Product;
use App\Http\Domains\Products\Request\StoreProductRequest;
use App\Http\Domains\Shared\ResponseService;
use Illuminate\Support\Facades\Validator;

class ProductService
{
    public function get() {
        return Product::all();
    }

    public function validate($data) {
        $validator = Validator::make($data, (new StoreProductRequest())->rules());

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
        $product = Product::create([
            'name' => $data['name'],
            'sku' => $data['sku'],
            'price' => $data['price'],
            'published_at' => $data['published_at'],
        ]);

        return ResponseService::success($product);
    }
}
