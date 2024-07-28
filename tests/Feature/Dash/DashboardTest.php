<?php

declare(strict_types=1);

use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

afterEach(function () {
    User::truncate();
});

test('dashboard screen can be rendered', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
    $response->assertViewIs('content.dashboard.dashboards-analytics');

})->group('DashboardController');
