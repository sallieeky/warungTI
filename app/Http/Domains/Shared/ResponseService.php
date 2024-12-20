<?php

namespace App\Http\Domains\Shared;

class ResponseService
{
    public static function success($data, $message = 'Success', $status = 200)
    {
        return  [
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ];
    }

    public static function error($message = 'Error', $status = 400)
    {
        return [
            'status' => 'error',
            'message' => $message
        ];
    }
}
