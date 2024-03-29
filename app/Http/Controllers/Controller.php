<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Traits\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, Response;

    protected function buildUnavailableResponse(): JsonResponse
    {
        $message = __('messages.errors.unavailable');

        return $this->response(response: [], statusCode: SymfonyResponse::HTTP_SERVICE_UNAVAILABLE, message: $message, success: false);
    }
}
