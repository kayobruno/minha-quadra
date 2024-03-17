<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseSymfony;

trait Response
{
    public function success($data, int $statusCode = ResponseSymfony::HTTP_OK): JsonResponse
    {
        $message = 'Everything is great!';

        return $this->response($data, $statusCode, $message);
    }

    public function badRequest(array $errors): JsonResponse
    {
        $message = 'The request cannot be fulfilled';

        return $this->response($errors, ResponseSymfony::HTTP_BAD_REQUEST, $message, success: false);
    }

    public function okButNoContent(): JsonResponse
    {
        $message = 'The server successfully processed the request, but is not returning any content.';

        return $this->response(null, ResponseSymfony::HTTP_NO_CONTENT, $message);
    }

    protected function response(mixed $response, int $statusCode, string $message, bool $success = true): JsonResponse
    {
        $data = [
            'success' => $success,
            'message' => $message,
            'data' => $response,
        ];

        return response()->json($data, $statusCode);
    }
}
