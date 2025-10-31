<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function annualServiceSettlements(): hasMany
    {
        $this->hasMany(AnnualServiceSettlement::class);
    }

    public function customServiceSettlements(): hasMany
    {
        $this->hasMany(CustomServiceSettlement::class);
    }

    public function universalSettlements(): hasMany
    {
        $this->hasMany(UniversalSettlement::class);
    }

    public function electricitySettlements(): hasMany
    {
        $this->hasMany(ElectricitySettlement::class);
    }

    public function depositSettlements(): HasMany
    {
        $this->hasMany(DepositSettlement::class);
    }

    public function summarySettlements(): hasMany
    {
        $this->hasMany(SummarySettlement::class);
    }

    public function tenants(): HasMany
    {
        return $this->hasMany(Tenant::class);
    }

    public function landlords(): HasMany
    {
        return $this->hasMany(Landlord::class);
    }

    public function buildingManagers(): HasMany
    {
        return $this->hasMany(BuildingManager::class);
    }

    public function electricitySuppliers(): HasMany
    {
        return $this->hasMany(ElectricitySupplier::class);
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }


    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

}
