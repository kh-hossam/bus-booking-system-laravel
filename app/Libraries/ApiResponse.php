<?php

namespace App\Libraries;

class ApiResponse
{
    public static function success($data, $message, $status = 200){
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $status);
    }


    public static function fail($data, $message, $status = 400){
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
