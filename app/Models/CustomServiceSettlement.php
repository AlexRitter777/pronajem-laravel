<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomServiceSettlement extends Model
{

    protected $fillable = [
        'property_id',
        'landlord_id',
        'tenant_id',
        'building_manager_id',
        'building_manager_settlement_start_date',
        'building_manager_settlement_end_date',
        'settlement_start_date',
        'settlement_end_date',
        'expenses',
        'total_annual_expenses',
        'meter_readings',
        'total_hot_water_meter_readings',
        'total_cold_water_meter_readings',
        'total_heating_meter_readings',
        'heating_coefficients',
        'total_heating_coefficients',
        'initial_reading_source',
        'final_reading_source',
        'hot_water_base_cost_year',
        'heating_base_cost_year',
        'hot_water_unit_price',
        'heating_unit_price',
        'cold_water_unit_price',
        'cold_water_for_hot_water_unit_price',
        'heating_price_correction',
        'corrected_heating_price',
        'heating_consumption_due_corrected_periods',
        'final_prices_corrections',
        'services_expenses_correction',
        'hot_water_expenses_correction',
        'heating_expenses_correction',
        'cold_water_expenses_correction',
        'payments',
        'total_annual_payments',
        'show_account_number',
        'account_number',
        'due_date',
        'user_id'

    ];

    protected $casts = [
        'expenses' => 'array',
        'meter_readings' => 'array',
        'payments' => 'array',
        'building_manager_settlement_start_date' => 'date:Y-m-d',
        'building_manager_settlement_end_date' => 'date:Y-m-d',
        'settlement_start_date' => 'date:Y-m-d',
        'settlement_end_date' => 'date:Y-m-d',
        'show_account_number' => 'boolean',
        'heating_price_correction' => 'boolean',
        'final_prices_corrections' => 'boolean'
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
