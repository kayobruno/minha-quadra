<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dash;

use App\DataTransferObjects\SupplierData;
use App\Enums\DocumentType;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dash\Supplier\CreateRequest;
use App\Http\Requests\Dash\Supplier\UpdateRequest;
use App\Models\Supplier;
use App\Services\SupplierService;

class SupplierController extends Controller
{
    public function __construct(private readonly SupplierService $supplierService)
    {
    }

    public function index()
    {
        $suppliers = $this->supplierService->paginate();

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
        $supplierData = SupplierData::fromRequest($request);
        $this->supplierService->save($supplierData);

        session()->flash('message', __('messages.success.created'));

        return redirect()->back();
    }

    public function edit(Supplier $supplier)
    {
        $statuses = Status::cases();
        $types = DocumentType::cases();

        return view('content.suppliers.edit', compact('statuses', 'types', 'supplier'));
    }

    public function update(UpdateRequest $request, Supplier $supplier)
    {
        $supplierData = SupplierData::fromRequest($request);
        $this->supplierService->update($supplier->id, $supplierData);
        session()->flash('message', __('messages.success.updated'));

        return redirect()->back();
    }

    public function delete(Supplier $supplier)
    {
        $this->supplierService->delete($supplier->id);
        session()->flash('message', __('messages.success.removed'));

        return redirect()->back();
    }
}
