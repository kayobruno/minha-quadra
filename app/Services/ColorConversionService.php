<?php

declare(strict_types=1);

namespace App\Services;

class ColorConversionService
{
    public function hexToRgba(string $hex, float $alpha = 1.0): string
    {
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) === 3) {
            $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
        } elseif (strlen($hex) !== 6) {
            throw new \InvalidArgumentException('Hexadecimal is invalid');
        }

        $rgb = sscanf($hex, '%02x%02x%02x');
        if ($rgb === false) {
            throw new \InvalidArgumentException('Hexadecimal is invalid');
        }

        return 'rgba(' . implode(',', $rgb) . ',' . $alpha . ')';
    }
}
