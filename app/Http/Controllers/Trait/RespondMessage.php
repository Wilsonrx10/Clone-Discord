<?php

namespace App\Http\Controllers\Trait;

Trait RespondMessage
{
    public function respondSuccess($message, $data = null)
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function respondError($message, $data = null)
    {
        return response()->json([
            'status' => 403,
            'message' => $message,
            'data' => $data
        ]);
    }
}