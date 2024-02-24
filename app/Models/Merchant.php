<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = [
        'trade_name',
        'document',
        'phone',
        'address',
        'logo',
        'business_hours',
        'status',
    ];

    protected $casts = [
        'status' => Status::class,
        'business_hours' => 'array',
    ];

    public function configs(): HasMany
    {
        return $this->hasMany(MerchantConfig::class);
    }
}
