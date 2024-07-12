<?php

declare(strict_types=1);

use App\Enums\InvoiceType;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Merchant;
use App\Models\Supplier;

afterEach(function () {
    InvoiceItem::truncate();
    Invoice::truncate();
    Merchant::truncate();
});

it('can create an invoice', function () {
    $merchant = Merchant::factory()->create();
    $supplier = Supplier::factory()->create();
    $invoice = Invoice::factory()->create([
        'merchant_id' => $merchant->id,
        'supplier_id' => $supplier->id,
        'serie' => 'A',
        'number' => 12345,
        'type' => InvoiceType::Receiving,
    ]);

    expect($invoice)->toBeInstanceOf(Invoice::class);
    expect($invoice->merchant_id)->toBe($merchant->id);
    expect($invoice->supplier_id)->toBe($supplier->id);
    expect($invoice->serie)->toBe('A');
    expect($invoice->number)->toBe(12345);
    expect($invoice->type)->toBe(InvoiceType::Receiving);
});

it('can access related merchant', function () {
    $merchant = Merchant::factory()->create();
    $invoice = Invoice::factory()->create([
        'merchant_id' => $merchant->id,
    ]);

    $relatedMerchant = $invoice->merchant;
    expect($relatedMerchant)->toBeInstanceOf(Merchant::class);
    expect($relatedMerchant->id)->toBe($merchant->id);
});

it('can access related items', function () {
    $invoice = Invoice::factory()->create();
    $items = InvoiceItem::factory()->count(3)->create([
        'invoice_id' => $invoice->id,
    ]);

    $relatedItems = $invoice->items;
    expect($relatedItems->count())->toBe(3);
    expect($relatedItems->first())->toBeInstanceOf(InvoiceItem::class);
});

it('casts type to InvoiceType enum', function () {
    $invoice = Invoice::factory()->create([
        'type' => InvoiceType::Issuing,
    ]);

    expect($invoice->type)->toBe(InvoiceType::Issuing);
});

it('can access related supplier', function () {
    $supplier = Supplier::factory()->create();
    $invoice = Invoice::factory()->create([
        'supplier_id' => $supplier->id,
    ]);

    $relatedSupplier = $invoice->supplier;
    expect($relatedSupplier)->toBeInstanceOf(Supplier::class);
    expect($relatedSupplier->id)->toBe($supplier->id);
});
