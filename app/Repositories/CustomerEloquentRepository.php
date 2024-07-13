<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\CustomerRepository;
use App\Contracts\DataParam;
use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CustomerEloquentRepository implements CustomerRepository
{
    public function __construct(private readonly Customer $model)
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

    public function findById(string $id): Customer
    {
        return $this->model::whereId($id)->first();
    }

    public function save(DataParam $dataParam): Customer
    {
        return $this->model::create($dataParam->toArray());
    }

    public function update(string $id, DataParam $dataParam): Customer
    {
        $customer = $this->model::whereId($id)->first();
        $customer->update($dataParam->toArray());

        return $customer;
    }

    public function delete(string $id): void
    {
        $customer = $this->model::whereId($id)->first();
        $customer->delete();
    }

    public function builder(): Builder
    {
        return $this->model::query();
    }
}
