<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\MeterType;

class SettlementMeter extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'settlement_id',
        'meter_type',
        'meter_type_name',
        'meter_number',
        'start_value',
        'end_value'
    ];

    protected function casts(): array
    {
        return [
            'start_value' => 'decimal:4',
            'end_value' => 'decimal:4',
            'settlement_type' => MeterType::class,
        ];
    }

    public function settlement(): BelongsTo
    {
        return $this->belongsTo(ServicesSettlement::class, 'settlement_id');
    }
}
