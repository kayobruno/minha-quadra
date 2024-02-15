<?php

declare(strict_types=1);

use App\Models\Court;
use App\Models\User;
use Illuminate\Support\Facades\DB;

afterEach(function () {
    DB::table('courts')->truncate();
    DB::table('users')->truncate();
});

test('it can list courts', function () {
    Court::factory()->count(10)->create();

    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/courts');

    $response->assertStatus(200);
    $response->assertViewIs('content.courts.index');
    $response->assertSee('Cadastrar');
    $response->assertSee('Nome');
})->group('CourtController');

test('courts screen can be rendered with empty list of courts', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/courts');

    $response->assertStatus(200);
    $response->assertViewIs('content.courts.index');
    $response->assertSee('Cadastrar');
    $response->assertSee('Nenhuma Quadra cadastrada!');
})->group('CourtController');

test('it can list courts with pagination', function () {
    Court::factory()->count(50)->create();

    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get('/courts');

    $response->assertStatus(200);
    $response->assertViewIs('content.courts.index');
    $response->assertSee('Cadastrar');
    $response->assertSee('page-item active');
})->group('CourtController');

test('redirect to login when user tries to list courts without being logged in', function () {
    $response = $this->get('/courts');

    $response->assertStatus(302);
    $response->assertSee('Redirecting to');
})->group('CourtController');
