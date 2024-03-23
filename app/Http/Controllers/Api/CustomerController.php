<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\CustomerResource;

class CustomerController extends Controller
{
    public function findByName(Request $request): JsonResponse
    {
        // TODO: Get merchant ID by logged in user
        $merchantId = 1;
        $name = $request->input('name', '');
        $customers = Customer::where('merchant_id', $merchantId)->where('name', 'like', "%{$name}%")->get();
        if (!$customers) {
            return $this->notFound();
        }

        return $this->success(CustomerResource::collection($customers));
    }
}
