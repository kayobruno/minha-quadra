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

test('the court update form screen can be rendered', function () {
    $court = Court::factory()->create();

    $response = $this->get('courts/' . $court->id);

    $response->assertStatus(200);
    $response->assertViewIs('content.courts.edit');
    $response->assertSee('Nome');
    $response->assertSee('Salvar');
})->group('CourtController');

test('update a court=', function () {
    $court = Court::factory()->create();

    $newAttributes = [
        'name' => 'Quadra 01',
    ];

    $this->put('courts/' . $court->id . '/update', $newAttributes);

    $this->assertDatabaseHas('courts', $newAttributes);
})->group('CourtController');

test('attempt to update a non-existing court', function () {
    $newAttributes = [
        'name' => 'Quadra 01',
    ];

    $response = $this->put('/courts/999/update', $newAttributes);

    $response->assertStatus(404);
    $this->assertDatabaseMissing('courts', $newAttributes);
})->group('CourtController');

test('update a court with required fields not provided', function () {
    $court = Court::factory()->create();
    $newAttributes = [
        'name' => '',
    ];

    $response = $this->put('/courts/' . $court->id . '/update', $newAttributes);

    $response->assertSessionHasErrors(['name']);
    $this->assertDatabaseMissing('courts', $newAttributes);
})->group('CourtController');
