<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\CustomerRepository;
use App\DataTransferObjects\CustomerDataParam;
use App\Models\Customer;

class CustomerService
{
    public function __construct(private CustomerRepository $customerRepository)
    {
    }

    public function createCustomer(CustomerDataParam $dataParam): Customer
    {
        return $this->customerRepository->save($dataParam);
    }
}
