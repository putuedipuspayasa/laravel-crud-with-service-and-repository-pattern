<?php

namespace App\Traits;

use Log;
use Symfony\Component\HttpFoundation\JsonResponse;

trait ResponseApi
{
    /**
     * Response success
     *
     * @param string $message
     * @param object $data
     * @param int $statusCode
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function success(string $message = null, object $data = null, int $statusCode = JsonResponse::HTTP_OK)
    {
        return response()->json([
            'status'  => $statusCode,
            'success' => true,
            'status_title' => 'success',
            'message' => $message,
            'data'    => $data
        ], $statusCode);
    }

    /**
     * Response error
     *
     * @param string $message
     * @param object $data
     * @param int $statusCode
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function error(string $message = null, int $statusCode = 500, object $data = null)
    {
        return response()->json([
            'status'     => $statusCode,
            'success'    => false,
            'message'    => $message ?? 'Something gone wrong',
            'data'       => $data
        ], $statusCode);
    }

    /**
     * Response error validator
     *
     * @param string $message
     * @param array $data
     * @param int $statusCode
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function errorValidation(string $message, object $error = null, int $statusCode = JsonResponse::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'status'    => $statusCode,
            'success'   => false,
            'message'   => $message,
            'data'      => null,
            'errors'    => $error
        ], $statusCode);
    }

}
