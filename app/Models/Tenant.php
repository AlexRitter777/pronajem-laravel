<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    /** @use HasFactory<\Database\Factories\TenantFactory> */
    use HasFactory;

    public function customServicesSettlements() : hasMany
    {
        return $this->hasMany(CustomServiceSettlement::class);
    }

    public function annualServiceSettlements() : hasMany
    {
        return $this->hasMany(AnnualServiceSettlement::class);
    }

    public function electricitySettlements() : hasMany
    {
        return $this->hasMany(ElectricitySettlement::class);
    }

}
