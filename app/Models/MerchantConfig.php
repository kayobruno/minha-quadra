<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MerchantConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'config_name',
        'config_value',
    ];

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'id');
    }
}
