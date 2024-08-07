<?php

declare(strict_types=1);

use App\Enums\DocumentType;
use App\Models\Merchant;
use App\Models\Supplier;
use App\Models\User;

beforeEach(function () {
    $this->merchant = Merchant::factory()->create();
    $this->user = User::factory()->create(['merchant_id' => $this->merchant->id]);
    $this->actingAs($this->user);
});

afterEach(function () {
    Supplier::truncate();
    User::truncate();
    Merchant::truncate();
});

test('the supplier update form screen can be rendered', function () {
    $supplier = Supplier::factory()->create();

    $response = $this->get('suppliers/' . $supplier->id);

    $response->assertStatus(200);
    $response->assertViewIs('content.suppliers.edit');
    $response->assertSee('Nome');
    $response->assertSee('Nome Fantasia');
    $response->assertSee('Tipo');
    $response->assertSee('Documento');
    $response->assertSee('Inscrição Estadual');
    $response->assertSee('Status');
    $response->assertSee('Salvar');
})->group('SupplierController');

test('update a supplier', function () {
    $supplier = Supplier::factory()->create();

    $newAttributes = [
        'name' => 'Novo Fornecedor de Teste',
        'document' => '64.356.481/0001-55',
        'type' => DocumentType::CNPJ->value,
    ];

    $this->put('suppliers/' . $supplier->id . '/update', $newAttributes);

    $this->assertDatabaseHas('suppliers', $newAttributes);
})->group('SupplierController');

test('attempt to update a non-existing supplier', function () {
    $newAttributes = [
        'name' => 'Fornecedor de Teste',
        'trade_name' => 'Teste',
        'document' => '123456789123',
        'type' => DocumentType::CNPJ->value,
    ];

    $response = $this->put('/suppliers/999/update', $newAttributes);

    $response->assertStatus(404);
    $this->assertDatabaseMissing('suppliers', $newAttributes);
})->group('SupplierController');

test('update a supplier with required fields not provided', function () {
    $supplier = Supplier::factory()->create();
    $newAttributes = [
        'name' => '',
        'trade_name' => 'Teste',
        'document' => '',
        'type' => DocumentType::CNPJ->value,
    ];

    $response = $this->put('/suppliers/' . $supplier->id . '/update', $newAttributes);

    $response->assertSessionHasErrors(['name', 'document']);
    $this->assertDatabaseMissing('suppliers', $newAttributes);
})->group('SupplierController');

test('update a supplier with invalid document', function (string $document) {
    $supplier = Supplier::factory()->create();
    $newAttributes = [
        'name' => '',
        'trade_name' => 'Teste',
        'document' => $document,
        'type' => DocumentType::CNPJ->value,
    ];

    $response = $this->put('/suppliers/' . $supplier->id . '/update', $newAttributes);

    $response->assertSessionHasErrors(['name', 'document']);
    $this->assertDatabaseMissing('suppliers', $newAttributes);
})->group('SupplierController')->with([
    'invalid CPF' => '000.000.000-00',
    'invalid CNPJ' => '00.000.000/0001-00',
]);

test('can not update a supplier with document duplicated', function () {
    Supplier::factory()->create(['document' => '916.000.800-00', 'merchant_id' => $this->merchant->id]);
    $supplier = Supplier::factory()->create(['merchant_id' => $this->merchant->id]);
    $newAttributes = [
        'name' => $supplier->name,
        'ean' => '916.000.800-00',
    ];

    $response = $this->put('/suppliers/' . $supplier->id . '/update', $newAttributes);

    $response->assertSessionHasErrors(['document']);
})->group('ProductController');
