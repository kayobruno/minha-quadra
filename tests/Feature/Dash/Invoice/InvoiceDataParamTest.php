<?php

declare(strict_types=1);

use App\DataTransferObjects\InvoiceDataParam;
use App\Enums\InvoiceType;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;

beforeEach(function () {
    $this->merchant = Merchant::factory()->create();
    $this->user = User::factory()->create(['merchant_id' => $this->merchant->id]);
    $this->actingAs($this->user);

    $this->type = InvoiceType::Issuing;
    $this->serie = 'A1';
    $this->number = '123';
});

test('The InvoiceDataParam can be created by construct correctly', function () {
    $invoiceData = new InvoiceDataParam(
        $this->type,
        $this->serie,
        $this->number
    );

    expect($invoiceData->type)->toBeInstanceOf(InvoiceType::class);
    expect($invoiceData->type)->toBe($this->type);
    expect($invoiceData->serie)->toBe($this->serie);
    expect($invoiceData->number)->toBe($this->number);
});

test('The InvoiceDataParam can be created by request correctly', function () {
    $request = new Request([
        'type' => InvoiceType::Issuing->value,
        'serie' => $this->serie,
        'number' => $this->number,
    ]);

    $invoiceData = InvoiceDataParam::fromRequest($request);

    expect($invoiceData->type)->toBe($this->type);
    expect($invoiceData->serie)->toBe($this->serie);
    expect($invoiceData->number)->toBe($this->number);
});
