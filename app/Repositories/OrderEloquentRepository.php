<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\DataParam;
use App\Contracts\OrderRepository;
use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class OrderEloquentRepository implements OrderRepository
{
    public function __construct(private readonly Order $model)
    {
    }

    public function getAll(): Collection
    {
        return $this->model::all();
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->model::paginate();
    }

    public function findById(string $id): Order
    {
        return $this->model::whereId($id)->first();
    }

    public function save(DataParam $dataParam): Order
    {
        return $this->model::create($dataParam->toArray());
    }

    public function update(string $id, DataParam $dataParam): Order
    {
        $order = $this->model::whereId($id)->first();
        $order->update($dataParam->toArray());

        return $order;
    }

    public function delete(string $id): void
    {
        $order = $this->model::whereId($id)->first();
        $order->delete();
    }

    public function builder(): Builder
    {
        return $this->model::query();
    }
}
