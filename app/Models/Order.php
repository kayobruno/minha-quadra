<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function isPaid(): bool
    {
        return $this->status === OrderStatus::Paid;
    }
}
