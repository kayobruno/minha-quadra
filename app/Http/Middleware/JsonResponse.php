<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Traits\Response as ResponseApi;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JsonResponse
{
    use ResponseApi;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        if (!$request->is('api/*')) {
            return $response;
        }

        if ($response->getStatusCode() === Response::HTTP_UNPROCESSABLE_ENTITY) {
            $errors = json_decode($response->getContent(), true)['errors'];

            return $this->badRequest($errors, $response->getStatusCode());
        }

        if ($response->isClientError()) {
            return $this->response([], Response::HTTP_INTERNAL_SERVER_ERROR, __('messages.errors.unavailable'), success: false);
        }

        return $response;
    }
}
