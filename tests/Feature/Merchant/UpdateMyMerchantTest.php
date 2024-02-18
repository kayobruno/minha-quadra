<?php

declare(strict_types=1);

use App\Models\Merchant;
use App\Models\User;
use Illuminate\Support\Facades\DB;

afterEach(function () {
    DB::table('merchants')->truncate();
    DB::table('users')->truncate();
});

test('the my Merchant update form screen can be rendered', function () {
    $merchant = Merchant::factory()->create();
    $user = User::factory()->for($merchant)->create();
    $this->actingAs($user);

    $response = $this->get('my-merchant');

    $response->assertStatus(200);
    $response->assertViewIs('content.merchants.edit');
    $response->assertSee('Razão Social');
    $response->assertSee('CNPJ');
    $response->assertSee('Telefone');
    $response->assertSee('Endereço');
    $response->assertSee('Salvar');
})->group('MerchantController');

test('update my merchant', function () {
    $merchant = Merchant::factory()->create();
    $user = User::factory()->create(['merchant_id' => $merchant->id]);
    $this->actingAs($user);

    $newAttributes = [
        'trade_name' => 'Arena de Teste',
        'phone' => '(85) 9 9999-9999',
        'address' => 'Rua A',
    ];

    $this->put('my-merchant/update', $newAttributes);

    $this->assertDatabaseHas('merchants', $newAttributes);
})->group('MerchantController');

test('update a Merchant with required fields not provided', function () {
    $merchant = Merchant::factory()->create();
    $user = User::factory()->for($merchant)->create();
    $this->actingAs($user);

    $newAttributes = [
        'trade_name' => '',
    ];

    $response = $this->put('/my-merchant/update', $newAttributes);

    $response->assertSessionHasErrors(['trade_name']);
    $this->assertDatabaseMissing('merchants', $newAttributes);
})->group('MerchantController');
