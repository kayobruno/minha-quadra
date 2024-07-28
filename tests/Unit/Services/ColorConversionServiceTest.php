<?php

declare(strict_types=1);

use App\Services\ColorConversionService;

it('converts 6-digit hex color to rgba', function () {
    $service = new ColorConversionService();
    $result = $service->hexToRgba('#ff5733', 0.5);
    expect($result)->toBe('rgba(255,87,51,0.5)');
});

it('converts 3-digit hex color to rgba', function () {
    $service = new ColorConversionService();
    $result = $service->hexToRgba('#f53', 0.7);
    expect($result)->toBe('rgba(255,85,51,0.7)');
});

it('throws an exception for invalid hex length', function () {
    $service = new ColorConversionService();
    $service->hexToRgba('#ff573');
})->throws(InvalidArgumentException::class, 'Hexadecimal is invalid');

it('throws an exception for invalid hex characters', function () {
    $service = new ColorConversionService();
    $service->hexToRgba('#---------');
})->throws(InvalidArgumentException::class, 'Hexadecimal is invalid');

it('converts hex color to rgba with default alpha value', function () {
    $service = new ColorConversionService();
    $result = $service->hexToRgba('#ff5733');
    expect($result)->toBe('rgba(255,87,51,1)');
});
