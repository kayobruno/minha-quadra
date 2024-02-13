<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = [
        'trade_name',
        'document',
        'phone',
        'address',
        'logo',
        'status',
    ];

    protected $casts = [
        'status' => Status::class,
    ];
}
