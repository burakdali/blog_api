<?php

namespace App\Traits;

trait ResponseTrait
{
    public function successWithData($data, $status = 200)
    {
        return response()->json([
            "status" => "success",
            "data" => $data
        ], $status);
    }
    function successWithMessage($message, $status = 200)
    {
        return response()->json(
            [
                "status" => "success",
                "message" => $message
            ],
            $status
        );
    }
    public function errorWithMessage($message, $status = 400)
    {
        return response()->json([
            "status" => "error",
            "Message" => $message
        ], $status);
    }
}
