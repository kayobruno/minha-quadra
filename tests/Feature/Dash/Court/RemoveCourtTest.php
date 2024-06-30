<?php

declare(strict_types=1);

use App\Models\Court;
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

test('can remove a court', function () {
    $court = Court::factory()->create();

    $this->delete('courts/' . $court->id);

    $this->assertDatabaseMissing('courts', ['id' => $court->id]);
})->group('CourtController');

test('attempt to remove a non-existing court', function () {
    Court::factory()->count(50)->create();
    $response = $this->delete('/courts/999');

    $response->assertStatus(404);
    $this->assertDatabaseCount('courts', 50);
})->group('CourtController');
