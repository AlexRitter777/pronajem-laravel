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
        $this->hasMany(AnnualServiceSettlement::class);
    }

    public function customServiceSettlements() : hasMany
    {
        $this->hasMany(CustomServiceSettlement::class);

    }

}
