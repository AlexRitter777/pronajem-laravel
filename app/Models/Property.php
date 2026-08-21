<?php

namespace App\Models;

use App\Traits\FormatsMoney;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use FormatsMoney;

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
        'contract_finished_at' => 'immutable_datetime',
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

    public function servicesSettlements(): HasMany
    {
        return $this->hasMany(ServicesSettlement::class);
    }

    public function rent_amount_formatted(): string
    {
        return $this->formatMoney($this->rent_amount, 'Kč');
    }

    public function service_charge_formatted(): string
    {
        return $this->formatMoney($this->service_charge, 'Kč');
    }

    public function electricity_charge_formatted(): string
    {
        return $this->formatMoney($this->electricity_charge, 'Kč');
    }

    public function deposit_amount_formatted(): string
    {
        return $this->formatMoney($this->deposit_amount, 'Kč');
    }
}
