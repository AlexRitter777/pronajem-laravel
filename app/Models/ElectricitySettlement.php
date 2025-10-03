<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ElectricitySettlement extends Model
{

    protected $fillable = [

        'property_id',
        'landlord_id',
        'tenant_id',
        'electricity_supplier_id',
        'settlement_start_date',
        'settlement_end_date',
        'initial_reading',
        'final_reading',
        'initial_reading_source',
        'final_reading_source',
        'unit_price_kwh',
        'monthly_price',
        'other_expenses',
        'other_expenses_description',
        'payments',
        'total_annual_payments',
        'show_account_number',
        'account_number',
        'due_date',
        'user_id',

    ];

    protected $casts = [
        'payments' => 'array',
        'show_account_number' => 'boolean',
        'settlement_start_date' => 'date:Y-m-d',
        'settlement_end_date' => 'date:Y-m-d',
    ];


    public function property() : BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function landlord() : BelongsTo
    {
        return $this->belongsTo(Landlord::class);
    }

    public function tenant() : BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
    public function electricitySupplier() : BelongsTo
    {
        return $this->belongsTo(ElectricitySupplier::class);
    }



}
