<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\CustomerRepository;
use App\Contracts\DataParam;
use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CustomerEloquentRepository implements CustomerRepository
{
    public function getAll(): Collection
    {
        return Customer::all();
    }

    public function paginate(): LengthAwarePaginator
    {
        return Customer::paginate();
    }

    public function findById(string $id): Model
    {
        return Customer::whereId($id)->first();
    }

    public function save(DataParam $dataParam): Model
    {
        return Customer::create($dataParam->toArray());
    }

    public function update(string $id, DataParam $dataParam): Model
    {
        $customer = Customer::whereId($id)->first();
        $customer->update($dataParam->toArray());

        return $customer;
    }

    public function delete(string $id): void
    {
        $customer = Customer::whereId($id)->first();
        $customer->delete();
    }

    public function builder(): Builder
    {
        return Customer::query();
    }
}
