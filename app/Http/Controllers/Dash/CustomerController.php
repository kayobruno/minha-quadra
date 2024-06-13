<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\DataTransferObjects\CustomerDataParam;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\Customers\CreateRequest;
use App\Http\Requests\Dash\Customers\UpdateRequest;
use App\Models\Customer;
use App\Services\CustomerService;

class CustomerController extends Controller
{
    public function __construct(private readonly CustomerService $customerService)
    {
    }

    public function index()
    {
        $customers = $this->customerService->paginate();

        return view('content.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('content.customers.create');
    }

    public function store(CreateRequest $request)
    {
        $customerData = CustomerDataParam::fromRequest($request);
        $this->customerService->save($customerData);

        session()->flash('message', __('messages.success.created'));

        return redirect()->back();
    }

    public function edit(Customer $customer)
    {
        return view('content.customers.edit', compact('customer'));
    }

    public function update(Customer $customer, UpdateRequest $request)
    {
        $customerData = CustomerDataParam::fromRequest($request);
        $this->customerService->update($customer->id, $customerData);
        session()->flash('message', __('messages.success.updated'));

        return redirect()->back();
    }

    public function delete(Customer $customer)
    {
        $this->customerService->delete($customer->id);
        session()->flash('message', __('messages.success.removed'));

        return redirect()->back();
    }
}
