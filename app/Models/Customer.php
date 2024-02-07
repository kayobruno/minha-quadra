<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
