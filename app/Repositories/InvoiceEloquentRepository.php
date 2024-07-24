<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\DataParam;
use App\Contracts\InvoiceRepository;
use App\Models\Invoice;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class InvoiceEloquentRepository implements InvoiceRepository
{
    public function __construct(private readonly Invoice $model)
    {
    }

    public function getAll(): Collection
    {
        return $this->model::all();
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->model::paginate();
    }

    public function findById(string $id): Invoice
    {
        return $this->model::whereId($id)->first();
    }

    public function save(DataParam $dataParam): Invoice
    {
        return $this->model::create($dataParam->toArray());
    }

    public function update(string $id, DataParam $dataParam): Invoice
    {
        $invoice = $this->model::whereId($id)->first();
        $invoice->update($dataParam->toArray());

        return $invoice;
    }

    public function delete(string $id): void
    {
        $invoice = $this->model::whereId($id)->first();
        $invoice->delete();
    }
}
