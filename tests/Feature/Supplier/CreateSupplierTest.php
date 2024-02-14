<?php

declare(strict_types=1);

use App\Enums\DocumentType;
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
    $response->assertSee('Nome/Razão Social');
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
    $response = $this->post('/suppliers/store', [
        'name' => 'Fornecedor de Teste',
        'trade_name' => 'Teste',
        'document' => '000.000.000-00',
        'tax_registration' => '123456',
        'type' => DocumentType::CPF->value,
    ]);

    $response->assertStatus(302);
    $response->assertSee('Redirecting to');
    $this->assertDatabaseHas('suppliers', ['name' => 'Fornecedor de Teste']);
})->group('SupplierController');
