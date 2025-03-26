<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ApiResponseService
{
    // Success Response
    public static function success($data = [], string $message = 'Success', int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    // Error Response
    public static function error(string $message = 'Error', int $status = 400, $errors = []): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors
        ], $status);
    }
}
