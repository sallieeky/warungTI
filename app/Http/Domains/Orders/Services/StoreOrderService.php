<?php

namespace App\Http\Domains\Orders\Services;

use App\Events\OrderCreated;
use App\Http\Domains\Orders\Model\Order;
use App\Http\Domains\Orders\Request\StoreOrderRequest;
use App\Http\Domains\Shared\ResponseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;

class StoreOrderService
{
    public function validate($data)
    {
        $validator = Validator::make($data, (new StoreOrderRequest())->rules());

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
        try {
            DB::beginTransaction();

            $validated = $this->validate($data);
            if ($validated['status'] == 'error') {
                return ResponseService::error($validated['message']);
            }
            $order = Order::create([
                'order_date' => $data['order_date'],
                'total_amount' => $data['total_amount'],
                'product_id' => $data['product_id']
            ]);
            OrderCreated::dispatch($order);

            return ResponseService::success($order);
        } catch (Exception $err) {
            return ResponseService::error('Failed to create product');
            DB::rollBack();
        }
    }
}
