<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\OrderRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderService
{
    public function __construct(private OrderRepository $orderRepository)
    {
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->orderRepository->paginate();
    }
}
