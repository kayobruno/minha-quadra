<?php

declare(strict_types=1);

use App\Models\User;
use App\Providers\RouteServiceProvider;

test('login screen can be rendered', function () {
    $response = $this->get('/login');
    $response->assertStatus(200);
})->group('AuthController');

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();
 
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
})->group('AuthController');

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();
 
    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
})->group('AuthController');
