<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepositSettlement extends Model
{
    protected $fillable = [
        'property_id',
        'landlord_id',
        'tenant_id',
        'contract_start_date',
        'contract_end_date',
        'contract_end_reason',
        'deposit_items',
        'total_deposit_items',
        'total_deposit',
        'show_account_number',
        'account_number',
        'due_date',
        'user_id'
    ];

    protected $casts = [
        'deposit_items' => 'array',
        'show_account_number' => 'boolean',
        'contract_start_date' => 'date:Y-m-d',
        'contract_end_date' => 'date:Y-m-d'
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



}
