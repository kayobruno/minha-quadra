<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'merchant_id',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getInitials(): string
    {
        $nameParts = explode(' ', $this->name);
        $initialsArray = array_map(function ($part) {
            return strtoupper($part[0]);
        }, array_filter($nameParts));

        return implode('', $initialsArray);
    }

    public function getTotalOrders(): int
    {
        return $this->orders()->count();
    }
}
