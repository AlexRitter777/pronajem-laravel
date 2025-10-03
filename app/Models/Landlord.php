<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Landlord extends Model
{
    /** @use HasFactory<\Database\Factories\LandlordFactory> */
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

    public function universalSettlements() : hasMany
    {
        return $this->hasMany(UniversalSettlement::class);
    }

    public function summarySettlements() : hasMany
    {
        return $this->hasMany(SummarySettlement::class);
    }

    public function depositSettlements() : hasMany
    {
        return $this->hasMany(DepositSettlement::class);
    }

}
