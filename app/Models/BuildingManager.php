<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BuildingManager extends Model
{
    /** @use HasFactory<\Database\Factories\BuildingManagerFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'accountant_name',
        'accountant_phone',
        'accountant_email',
        'technician_name',
        'technician_phone',
        'technician_email',
        'user_id'
    ];

    public function properties() : hasMany
    {
        return $this->hasMany(Property::class);
    }
    public function customServicesSettlements() : hasMany
    {
        $this->hasMany(CustomServiceSettlement::class);
    }

    public function annualServiceSettlements() : hasMany
    {
        $this->hasMany(AnnualServiceSettlement::class);
    }


}
