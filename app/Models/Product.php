<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'name',
        'description',
        'price',
        'type',
        'stock',
        'status',
    ];

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'id');
    }
}
