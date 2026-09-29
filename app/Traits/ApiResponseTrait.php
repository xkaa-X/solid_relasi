<?php

namespace App\Traits;

use Exception;

trait ApiResponseTrait
{
    protected function successResponse($data, string $message = 'Success', int $code = 200) {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ]);
    }

    protected function erorrResponse(Exception $exception, string $message = 'Errors', int $code = 500) {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $exception->getMessage()
        ]);
    }
}