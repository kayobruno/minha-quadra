<?php

declare(strict_types=1);

use App\Enums\DocumentType;
use App\Enums\Status;
use App\Models\Merchant;
use App\Models\Supplier;

afterEach(function () {
    Merchant::truncate();
    Supplier::truncate();
});

it('can create a supplier', function () {
    $merchant = Merchant::factory()->create();

    $supplier = Supplier::factory()->create([
        'merchant_id' => $merchant->id,
        'name' => 'Supplier Name',
        'trade_name' => 'Supplier Trade Name',
        'document' => '123456789',
        'tax_registration' => '987654321',
        'type' => DocumentType::CNPJ,
        'status' => Status::Active,
    ]);

    expect($supplier)->toBeInstanceOf(Supplier::class);
    expect($supplier->merchant_id)->toBe($merchant->id);
    expect($supplier->name)->toBe('Supplier Name');
    expect($supplier->trade_name)->toBe('Supplier Trade Name');
    expect($supplier->document)->toBe('123456789');
    expect($supplier->tax_registration)->toBe('987654321');
    expect($supplier->type)->toBe(DocumentType::CNPJ);
    expect($supplier->status)->toBe(Status::Active);
});

it('can access related merchant', function () {
    $merchant = Merchant::factory()->create();
    $supplier = Supplier::factory()->create([
        'merchant_id' => $merchant->id,
    ]);

    expect($supplier->merchant)->toBeInstanceOf(Merchant::class);
    expect($supplier->merchant->id)->toBe($merchant->id);
});

it('casts status and type to enums', function () {
    $supplier = Supplier::factory()->create([
        'status' => Status::Inactive,
        'type' => DocumentType::CPF,
    ]);

    expect($supplier->status)->toBe(Status::Inactive);
    expect($supplier->type)->toBe(DocumentType::CPF);
});
