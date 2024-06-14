<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\OrderRepository;
use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class OrderEloquentRepository implements OrderRepository
{
    public function getAll(): Collection
    {
        return Order::all();
    }

    public function paginate(): LengthAwarePaginator
    {
        return Order::paginate();
    }

    public function findById(string $id): Model
    {
        return Order::whereId($id)->first();
    }
}
