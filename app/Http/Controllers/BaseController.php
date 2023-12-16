<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

trait BaseController
{
    function success(array|object|null $data = null, string|int|bool|null $message = null, int $code = 200): JsonResponse
    {
        return Response::json([
            "success" => true,
            "message" => $message,
            "data" => $data,
            "code" => $code
        ]);
    }

    function error(array|object|null $data = null, string|int|bool|null $message = null, int $code = 500): JsonResponse
    {
        return Response::json([
            "success" => true,
            "message" => $message,
            "data" => $data,
            "code" => $code
        ]);
    }
}
