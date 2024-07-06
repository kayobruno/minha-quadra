<?php

declare(strict_types=1);

use App\Enums\ProductType;

it('returns all product types', function () {
    $expected = ['product', 'service'];
    $actual = ProductType::all();

    $this->assertEquals($expected, $actual);
});

it('returns correct label for each product type', function () {
    $productLabel = ProductType::Product->label();
    $serviceLabel = ProductType::Service->label();

    $this->assertEquals('Produto', $productLabel);
    $this->assertEquals('Serviço', $serviceLabel);
});
