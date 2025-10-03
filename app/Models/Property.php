<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    /** @use HasFactory<\Database\Factories\PropertyFactory> */
    use HasFactory;



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
