<?php

namespace App\Models;

use App\Domains\ServiceSettlement\Enums\CoefficientMode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServicesSettlement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'landlord_id',
        'landlord_name',
        'landlord_address',
        'tenant_id',
        'tenant_name',
        'tenant_address',
        'property_id',
        'property_address',
        'property_type',
        'invoicing_year',
        'tenant_occupancy_start_date',
        'tenant_occupancy_end_date',
        'coefficient_mode',
        'coef_expenses',
        'coef_hot_water',
        'coef_heating',
        'coef_cold_water_waste',
        'utility_hot_water',
        'utility_cold_water',
        'utility_heating',
        'utility_cold_water_for_hot',
        'hot_water_fixed_amount',
        'hot_water_unit_price',
        'cold_water_for_hot_unit_price',
        'cold_water_unit_price',
        'heating_fixed_amount',
        'heating_unit_price',
        'has_heating_coefficients',
        'heating_coefficient_first',
        'heating_coefficient_second',
        'heating_coefficient_third',
        'has_annual_consumption',
        'meter_start_year_value',
        'meter_end_year_value',
        'annual_consumption',
    ];

    protected function casts(): array
    {
        return [
            'invoicing_year' => 'integer',
            'tenant_occupancy_start_date' => 'immutable_date',
            'tenant_occupancy_end_date' => 'immutable_date',
            'coefficient_mode' => CoefficientMode::class,
            'coef_expenses' => 'decimal:3',
            'coef_hot_water' => 'decimal:3',
            'coef_heating' => 'decimal:3',
            'coef_cold_water_waste' => 'decimal:3',
            'utility_hot_water' => 'decimal:2',
            'utility_cold_water' => 'decimal:2',
            'utility_heating' => 'decimal:2',
            'utility_cold_water_for_hot' => 'decimal:2',
            'hot_water_fixed_amount' => 'decimal:4',
            'hot_water_unit_price' => 'decimal:4',
            'cold_water_for_hot_unit_price' => 'decimal:4',
            'cold_water_unit_price' => 'decimal:4',
            'heating_fixed_amount' => 'decimal:4',
            'heating_unit_price' => 'decimal:4',
            'has_heating_coefficients' => 'boolean',
            'heating_coefficient_first' => 'decimal:4',
            'heating_coefficient_second' => 'decimal:4',
            'heating_coefficient_third' => 'decimal:4',
            'has_annual_consumption' => 'boolean',
            'meter_start_year_value' => 'decimal:4',
            'meter_end_year_value' => 'decimal:4',
            'annual_consumption' => 'decimal:2',
            'result_balance' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function landlord(): BelongsTo
    {
        return $this->belongsTo(Landlord::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function meters(): HasMany
    {
        return $this->hasMany(SettlementMeter::class, 'settlement_id');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(SettlementExpense::class, 'settlement_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(SettlementPayment::class, 'settlement_id');
    }
}
