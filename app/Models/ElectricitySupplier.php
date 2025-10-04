<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricitySupplier extends Model
{
    /** @use HasFactory<\Database\Factories\ElectricitySupplierFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function electricitySettlements() {

        return $this->hasMany(ElectricitySettlement::class);

    }

}
