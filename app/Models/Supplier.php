<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\DocumentType;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'name',
        'trade_name',
        'document',
        'tax_registration',
        'type',
        'status',
    ];

    protected $casts = [
        'id' => 'string',
        'status' => Status::class,
        'type' => DocumentType::class,
    ];

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'id');
    }
}
