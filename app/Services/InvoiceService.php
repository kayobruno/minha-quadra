<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\InvoiceDataParam;
use App\Models\Invoice;
use App\Repositories\InvoiceEloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class InvoiceService
{
    public function __construct(private readonly InvoiceEloquentRepository $invoiceRepository)
    {
    }

    public function getAll(): Collection
    {
        return $this->invoiceRepository->getAll();
    }

    public function paginate(): LengthAwarePaginator
    {
        return $this->invoiceRepository->paginate();
    }

    public function findById(string $id): Invoice
    {
        return $this->invoiceRepository->findById($id);
    }

    public function save(InvoiceDataParam $dataParam): Invoice
    {
        return $this->invoiceRepository->save($dataParam);
    }

    public function update(string $id, InvoiceDataParam $dataParam): Invoice
    {
        return $this->invoiceRepository->update($id, $dataParam);
    }

    public function delete(string $id): void
    {
        $this->invoiceRepository->delete($id);
    }
}
