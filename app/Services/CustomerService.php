<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\CustomerRepository;
use App\DataTransferObjects\CustomerDataParam;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CustomerService
{
    public function __construct(private CustomerRepository $customerRepository)
    {
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->customerRepository->paginate();
    }

    public function save(CustomerDataParam $dataParam): Model
    {
        return $this->customerRepository->save($dataParam);
    }

    public function update(string $id, CustomerDataParam $dataParam): Model
    {
        return $this->customerRepository->update($id, $dataParam);
    }

    public function delete(string $id): void
    {
        $this->customerRepository->delete($id);
    }

    public function findByName(CustomerDataParam $customerData): Collection
    {
        return $this->customerRepository->builder()
            ->where('merchant_id', $customerData->merchantId)
            ->where('name', 'like', "%{$customerData->name}%")
            ->limit(10)
            ->get();
    }
}
