<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'merchant_id',
    ];

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'id');
    }
}
