<?php

namespace App\Http\Controllers\Dash;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\Customers\CreateRequest;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10);

        return view('content.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('content.customers.create');
    }

    public function store(CreateRequest $request)
    {
        Customer::create($request->all());
        session()->flash('message', __('messages.success.created'));

        return redirect()->back();
    }
}
