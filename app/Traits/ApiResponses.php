<?php

namespace App\Traits;

use App\Http\Resources\ClientResource;

trait ApiResponses
{
    protected function successResponse($data, $message = 'Success', $code = 200)
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

    protected function customResponse($status, $data, $message, $code)
    {
        response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }
    protected function destroyResponse($message = 'Deleted', $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
        ], $code);
    }
}
