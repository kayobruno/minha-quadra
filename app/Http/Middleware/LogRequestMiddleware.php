<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Contracts\LoggerInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogRequestMiddleware
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        if (app()->environment('production')) {
            $this->logRequest($request, $response);
        }

        return $response;
    }

    protected function logRequest(Request $request, $response): void
    {
        $data = [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'headers' => $request->headers->all(),
            'body' => $request->all(),
            'response_status' => $response->status(),
            'timestamp' => now()->toIso8601String(),
        ];

        $this->logger->log($data);
    }
}
