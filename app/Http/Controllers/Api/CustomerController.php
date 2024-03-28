<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function findByName(Request $request): JsonResponse
    {
        $merchantId = auth()->user()->merchant_id;
        $name = $request->input('name', '');
        $customers = Customer::where('merchant_id', $merchantId)->where('name', 'like', "%{$name}%")->get();
        if (!$customers) {
            return $this->notFound();
        }

        return $this->success(CustomerResource::collection($customers));
    }
}
