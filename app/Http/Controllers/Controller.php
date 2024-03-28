<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Traits\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, Response;

    protected function buildUnavailableResponse(): JsonResponse
    {
        $message = __('messages.errors.unavailable');
        return $this->response(response: [], statusCode: SymfonyResponse::HTTP_SERVICE_UNAVAILABLE, message: $message, success: false);
    }
}
