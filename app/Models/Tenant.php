<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends Model
{
    /** @use HasFactory<\Database\Factories\TenantFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'birthday',
        'email',
        'phone',
        'account_number',
        'user_id',
    ];

    protected $casts = [
        'birthday' => 'datetime',
    ];

    public function properties(): hasMany
    {
        return $this->hasMany(Property::class);
    }

    public function servicesSettlements(): HasMany
    {
        return $this->hasMany(ServicesSettlement::class);
    }
}
