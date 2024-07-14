<?php

declare(strict_types=1);

use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('the invoice list screen can be rendered', function () {
    $response = $this->get('/invoices');

    $response->assertStatus(200);
    $response->assertViewIs('content.invoices.index');
})->group('InvoiceController');
