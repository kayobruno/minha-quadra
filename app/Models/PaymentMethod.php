<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'name',
        'status',
    ];

    protected $casts = [
        'status' => Status::class,
    ];
}
