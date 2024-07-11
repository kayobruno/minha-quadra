<?php

declare(strict_types=1);

use App\Enums\DocumentType;
use App\Enums\Status;
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

test('the supplier registration form screen can be rendered', function () {
    $response = $this->get('/suppliers/create');

    $response->assertStatus(200);
    $response->assertViewIs('content.suppliers.create');
    $response->assertSee('Nome');
    $response->assertSee('Nome Fantasia');
    $response->assertSee('Tipo');
    $response->assertSee('Documento');
    $response->assertSee('Inscrição Estadual');
    $response->assertSee('Status');
    $response->assertSee('Salvar');
})->group('SupplierController');

test('validates required fields when creating a new supplier', function () {
    $response = $this->post('/suppliers/store', []);

    $response->assertSessionHasErrors(['name', 'document']);
})->group('SupplierController');

test('can create a new supplier', function () {
    $expectedData = [
        'name' => 'Fornecedor de Teste',
        'trade_name' => 'Teste',
        'document' => '417.964.830-01',
        'tax_registration' => '123456',
        'type' => DocumentType::CPF->value,
        'status' => Status::Active->value,
    ];

    $response = $this->post('/suppliers/store', $expectedData);

    $response->assertStatus(302);
    $response->assertSee('Redirecting to');
    $this->assertDatabaseHas('suppliers', $expectedData);
})->group('SupplierController');

test('validates document field when creating a new supplier with document invalid', function (string $document) {
    $response = $this->post('/suppliers/store', [
        'name' => 'Fornecedor de Teste',
        'trade_name' => 'Teste',
        'document' => $document,
        'tax_registration' => '123456',
        'type' => DocumentType::CPF->value,
    ]);

    $response->assertSessionHasErrors(['document']);
})->group('SupplierController')->with([
    'invalid CPF' => '000.000.000-00',
    'invalid CNPJ' => '00.000.000/0001-00',
]);
