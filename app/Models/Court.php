<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\ColorConversionService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Court extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color',
        'merchant_id',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    public function getColorRgbaAttribute(): string
    {
        $colorConversionService = new ColorConversionService();

        return $colorConversionService->hexToRgba($this->color, 0.5);
    }
}
