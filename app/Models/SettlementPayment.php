<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SettlementPayment extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'settlement_id',
        'payment_month',
        'payment_year',
        'amount'
    ];

    protected function casts(): array
    {
        return [
            'payment_month' => 'integer',
            'payment_year' => 'integer',
            'amount' => 'decimal:2'
        ];
    }

    public function settlement(): BelongsTo
    {
        return $this->belongsTo(ServicesSettlement::class, 'settlement_id');
    }
}
