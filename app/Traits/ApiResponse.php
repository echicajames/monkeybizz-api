<?php

namespace App\Traits;

trait ApiResponse
{
    protected function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => null
        ], $code);
    }

    protected function createdResponse($data, $message = 'Resource created successfully')
    {
        return $this->successResponse($data, $message, 201);
    }

    protected function noContentResponse($message = 'Resource deleted successfully')
    {
        return $this->successResponse(null, $message, 204);
    }
} 