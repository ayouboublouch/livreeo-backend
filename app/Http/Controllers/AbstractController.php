<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

abstract class AbstractController
{
    /**
     * Respond successfully with item
     * @param array $data = []
     * 
     * @return JsonResponse
     */
    public function successResponseWithData(array $data = []): JsonResponse
    {
        return new JsonResponse(
            array_merge(['status' => 'success'], $data),
            Response::HTTP_OK,
        );
    }

    /**
     * Respond with not error
     * @param int $errorCode = Response::HTTP_BAD_REQUEST
     * @param array $data = []
     * 
     * @return JsonResponse
     */
    public function errorResponse(int $errorCode = Response::HTTP_BAD_REQUEST, array $data = []): JsonResponse
    {
        return new JsonResponse(
            array_merge(['status' => 'error'], $data),
            $errorCode,
        );
    }
}
