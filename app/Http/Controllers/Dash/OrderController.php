<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')->paginate(10);

        return view('content.orders.index', compact('orders'));
    }
}
