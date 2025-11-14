<?php

namespace App\Models;

use App\Casts\MoneyDisplayCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;

    protected $fillable = [
        'type',
        'description',
        'address',
        'rent_amount',
        'service_charge',
        'electricity_charge',
        'deposit_amount',
        'contract_finished_at',
        'landlord_id',
        'tenant_id',
        'electricity_supplier_id',
        'building_manager_id',
        'user_id'
    ];

    protected $casts = [
        'contract_finished_at' => 'datetime',
        'rent_amount' => MoneyDisplayCast::class,
        'service_charge' => MoneyDisplayCast::class,
        'electricity_charge' => MoneyDisplayCast::class,
    ];
    public function landlord(): BelongsTo
    {
        return $this->belongsTo(Landlord::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function buildingManager(): BelongsTo
    {
        return $this->belongsTo(BuildingManager::class);
    }

    public function electricitySupplier(): BelongsTo
    {
        return $this->belongsTo(ElectricitySupplier::class);
    }

    public function annualServiceSettlements() : hasMany
    {
        return $this->hasMany(AnnualServiceSettlement::class);
    }

    public function customServiceSettlements() : hasMany
    {
        return $this->hasMany(CustomServiceSettlement::class);

    }

    public function electricitySettlements() : hasMany
    {
        return $this->hasMany(ElectricitySettlement::class);
    }

    public function universalSettlements() : HasMany
    {
        return $this->hasMany(UniversalSettlement::class);
    }


    public function summarySettlements() : HasMany
    {
        return $this->hasMany(SummarySettlement::class);
    }

    public function depositSettlements() : HasMany
    {
        return $this->hasMany(DepositSettlement::class);
    }

}
