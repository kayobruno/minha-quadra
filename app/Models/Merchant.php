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
        'id' => 'string',
        'status' => Status::class,
        'business_hours' => 'array',
    ];

    public function configs(): HasMany
    {
        return $this->hasMany(MerchantConfig::class);
    }

    public function getTabsTotal(): int
    {
        return (int) $this->configs()->where('config_name', 'tab_total')->pluck('config_value')->first();
    }

    public function getMinHoursReserve(): int
    {
        return (int) $this->configs()->where('config_name', 'min_hours_reserve')->pluck('config_value')->first();
    }
}
