<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnnualServiceSettlement extends Model
{
    protected $fillable = [
        'property_id',
        'landlord_id',
        'tenant_id',
        'building_manager_id',
        'year',
        'expenses',
        'total_annual_expenses',
        'payments',
        'total_annual_payments',
        'show_account_number',
        'account_number',
        'due_date',
        'user_id',
    ];

    protected $casts = [
        'expenses' => 'array',
        'payments' => 'array',
        'show_account_number' => 'boolean'
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

    public function buildingManager() : BelongsTo
    {
        return $this->belongsTo(BuildingManager::class);
    }


}
