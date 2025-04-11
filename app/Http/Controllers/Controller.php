<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param mixed $data
     * @param int $status
     * @return JsonResponse
     */
    public function response(mixed $data, int $status = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
        ], $status);
    }

    /**
     * @param string $message
     * @param $data
     * @param int $status
     * @return JsonResponse
     */
    public function success(string $message, $data = null, int $status = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function error(string $message, int $status): JsonResponse
    {
        if ($status < 100 || $status > 599) {
            $status = 400;
        }

        return response()->json([
            'message' => $message,
        ], $status);
    }
}
