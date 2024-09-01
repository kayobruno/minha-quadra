<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DataTransferObjects\OrderDataParam;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\InitOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function __construct(private readonly OrderService $orderService)
    {
    }

    public function initOrder(InitOrderRequest $request): JsonResponse
    {
        try {
            $orderDataParam = OrderDataParam::fromRequest($request);
            $this->orderService->initOrder($orderDataParam);

            return $this->success(null, Response::HTTP_CREATED);
        } catch (\Exception) {
            return $this->buildUnavailableResponse();
        }
    }
}
