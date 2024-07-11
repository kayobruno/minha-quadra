<?php

declare(strict_types=1);

use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('the invoice registration form screen can be rendered', function () {
    $response = $this->get('/invoices/create');

    $response->assertStatus(200);
    $response->assertViewIs('content.invoices.create');
    $response->assertSee('type');
    $response->assertSee('serie');
    $response->assertSee('number');
})->group('InvoiceController');
