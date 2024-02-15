<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

afterEach(function () {
    DB::table('courts')->truncate();
    DB::table('users')->truncate();
});

test('the courts registration form screen can be rendered', function () {
    $response = $this->get('/courts/create');

    $response->assertStatus(200);
    $response->assertViewIs('content.courts.create');
    $response->assertSee('Nome');
    $response->assertSee('Salvar');
})->group('CourtController');

test('validates required fields when creating a new court', function () {
    $response = $this->post('/courts/store', []);

    $response->assertSessionHasErrors(['name']);
})->group('CourtController');

test('can create a new courts', function () {
    $response = $this->post('/courts/store', [
        'name' => 'Quadra 01',
    ]);

    $response->assertStatus(302);
    $response->assertSee('Redirecting to');
    $this->assertDatabaseHas('courts', ['name' => 'Quadra 01']);
})->group('CourtController');
