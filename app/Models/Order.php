<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => OrderStatus::class,
    ];

    protected $fillable = [
        'user_id',
        'merchant_id',
        'customer_id',
        'subtotal',
        'total_amount',
        'total_discount',
        'tab',
        'status',
    ];
}
