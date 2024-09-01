<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(private readonly OrderService $orderService)
    {
    }

    public function index()
    {
        $availableTabs = $this->orderService->getAvailableTabsByMerchant(auth()->user()->merchant);
        $orders = $this->orderService->paginate();

        return view('content.orders.index', compact('orders', 'availableTabs'));
    }

    public function create()
    {
        return view('content.orders.create');
    }

    public function show(Order $order)
    {
        return view('content.orders.view', compact('order'));
    }
}
