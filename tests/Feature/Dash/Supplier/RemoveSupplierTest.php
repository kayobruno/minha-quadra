<?php

declare(strict_types=1);

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

test('can remove a supplier', function () {
    $supplier = Supplier::factory()->create();

    $this->delete('suppliers/' . $supplier->id);

    $this->assertDatabaseMissing('suppliers', ['id' => $supplier->id]);
})->group('SupplierController');

test('attempt to remove a non-existing supplier', function () {
    Supplier::factory()->count(50)->create();
    $response = $this->delete('/suppliers/999');

    $response->assertStatus(404);
    $this->assertDatabaseCount('suppliers', 50);
})->group('SupplierController');
