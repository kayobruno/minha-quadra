<?php

namespace App\Http\Controllers\Dash;

use App\Enums\DocumentType;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\Supplier\CreateRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::paginate(10);

        return view('content.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        $statuses = Status::cases();
        $types = DocumentType::cases();

        return view('content.suppliers.create', compact('statuses', 'types'));
    }

    public function store(CreateRequest $request)
    {
        $merchantId = auth()->user()->merchant_id;
        $data = array_merge($request->all(), ['merchant_id' => $merchantId]);

        Supplier::create($data);

        session()->flash('message', __('messages.success.created'));

        return redirect()->back();
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function delete(string $id)
    {
        //
    }
}
