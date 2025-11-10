<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ElectricitySupplier extends Model
{
    /** @use HasFactory<\Database\Factories\ElectricitySupplierFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function properties() : hasMany
    {
        return $this->hasMany(Property::class);
    }
    public function electricitySettlements() {

        return $this->hasMany(ElectricitySettlement::class);

    }

}
