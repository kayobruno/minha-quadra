<?php

declare(strict_types=1);

use App\Models\Merchant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

afterEach(function () {
    Merchant::truncate();
    User::truncate();
});

it('can create a user', function () {
    $merchant = Merchant::factory()->create();
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'merchant_id' => $merchant->id,
    ]);

    expect($user)->toBeInstanceOf(User::class);
    expect($user->name)->toBe('Test User');
    expect($user->email)->toBe('test@example.com');
    expect($user->merchant_id)->toBe($merchant->id);
    expect(Hash::check('password', $user->password))->toBeTrue();
});

it('can access related merchant', function () {
    $merchant = Merchant::factory()->create();

    $user = User::factory()->create([
        'merchant_id' => $merchant->id,
    ]);

    expect($user->merchant)->toBeInstanceOf(Merchant::class);
    expect($user->merchant->id)->toBe($merchant->id);
});

it('casts email_verified_at and merchant_id correctly', function () {
    $user = User::factory()->create([
        'email_verified_at' => now(),
        'merchant_id' => 'some-merchant-id',
    ]);

    expect($user->email_verified_at)->toBeInstanceOf(\Illuminate\Support\Carbon::class);
    expect($user->merchant_id)->toBe('some-merchant-id');
});
