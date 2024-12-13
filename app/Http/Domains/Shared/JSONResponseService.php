<?php

namespace App\Http\Domains\Shared;

class JSONResponseService
{
    public static function success($data, $message = 'Success', $status = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $status);
    }
}
