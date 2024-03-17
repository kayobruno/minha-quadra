<?php

declare(strict_types=1);

use App\Services\ColorConversionService;

it('can convert hex color to rgba', function () {
    $colorConversionService = new ColorConversionService();

    $hexColor = '#FFA500';
    $rgbaColor = $colorConversionService->hexToRgba($hexColor);

    expect($rgbaColor)->toBe('rgba(255,165,0,1)');
});

it('can convert hex color to rgba with alpha', function () {
    $colorConversionService = new ColorConversionService();

    $hexColor = '#FFA500';
    $alpha = 0.5;
    $rgbaColor = $colorConversionService->hexToRgba($hexColor, $alpha);

    expect($rgbaColor)->toBe('rgba(255,165,0,0.5)');
});

it('throws an exception for invalid hex color', function () {
    $colorConversionService = new ColorConversionService();

    $invalidHexColor = 'invalid';
    expect(function () use ($colorConversionService, $invalidHexColor) {
        $colorConversionService->hexToRgba($invalidHexColor);
    })->toThrow(\InvalidArgumentException::class);
});
