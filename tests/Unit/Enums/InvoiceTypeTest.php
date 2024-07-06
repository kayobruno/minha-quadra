<?php

declare(strict_types=1);

use App\Enums\InvoiceType;

test('it returns all invoice types', function () {
    $expected = ['receiving', 'issuing'];
    $actual = InvoiceType::all();

    $this->assertEquals($expected, $actual);
});
