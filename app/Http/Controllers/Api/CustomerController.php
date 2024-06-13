<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DataTransferObjects\CustomerDataParam;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\CustomerResource;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function findByName(Request $request, CustomerService $customerService): JsonResponse
    {
        $customerData = new CustomerDataParam($request->input('name', ''));
        $customers = $customerService->findByName($customerData);

        if (!$customers) {
            return $this->notFound();
        }

        return $this->success(CustomerResource::collection($customers));
    }
}
