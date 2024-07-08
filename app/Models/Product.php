<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProductType;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'name',
        'description',
        'price',
        'type',
        'ean',
        'manage_stock',
        'stock',
        'status',
    ];

    protected $casts = [
        'id' => 'string',
        'status' => Status::class,
        'type' => ProductType::class,
        'price' => 'float',
    ];

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    public function getPriceFormattedAttribute(): string
    {
        return number_format($this->price, 2, ',', '.');
    }
}
