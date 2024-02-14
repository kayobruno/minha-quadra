<?php

declare(strict_types=1);

use App\Enums\DocumentType;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

afterEach(function () {
    DB::table('suppliers')->truncate();
    DB::table('users')->truncate();
});

test('the supplier update form screen can be rendered', function () {
    $supplier = Supplier::factory()->create();

    $response = $this->get('suppliers/' . $supplier->id);

    $response->assertStatus(200);
    $response->assertViewIs('content.suppliers.edit');
    $response->assertSee('Nome/Razão Social');
    $response->assertSee('Nome Fantasia');
    $response->assertSee('Tipo');
    $response->assertSee('Documento');
    $response->assertSee('Inscrição Estadual');
    $response->assertSee('Status');
    $response->assertSee('Salvar');
})->group('ProductController');

test('update a supplier', function () {
    $supplier = Supplier::factory()->create();

    $newAttributes = [
        'name' => 'Novo Fornecedor de Teste',
        'trade_name' => 'Novo Teste',
        'document' => '64.356.481/0001-55',
        'tax_registration' => '123456',
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
        'tax_registration' => '123456',
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
        'tax_registration' => '123456',
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
        'tax_registration' => '123456',
        'type' => DocumentType::CNPJ->value,
    ];

    $response = $this->put('/suppliers/' . $supplier->id . '/update', $newAttributes);

    $response->assertSessionHasErrors(['name', 'document']);
    $this->assertDatabaseMissing('suppliers', $newAttributes);
})->group('SupplierController')->with([
    'invalid CPF' => '000.000.000-00',
    'invalid CNPJ' => '00.000.000/0001-00',
]);
