<?php

namespace App\Dto\Property;

use Illuminate\Support\Arr;

final readonly class PropertyData
{

    public string $address;
    public string $type;
    public ?string $description;
    public ?int $rent_amount;
    public ?int $service_charge;
    public ?int $electricity_charge;
    public ?int $deposit_amount;
    public ?string $contract_finished_at;
    public ?int $landlord_id;
    public ?int $tenant_id;
    public ?int $building_manager_id;
    public ?int $electricity_supplier_id;


    public function __construct(public readonly array $propertyData){
        $this->address = Arr::get($this->propertyData, 'address');
        $this->type = Arr::get($this->propertyData, 'type');
        $this->description = Arr::get($this->propertyData, 'description');
        $this->rent_amount = Arr::get($this->propertyData, 'rent_amount');
        $this->service_charge = Arr::get($this->propertyData, 'service_charge');
        $this->electricity_charge = Arr::get($this->propertyData, 'electricity_charge');
        $this->deposit_amount = Arr::get($this->propertyData, 'deposit_amount');
        $this->contract_finished_at = Arr::get($this->propertyData, 'contract_finished_at');
        $this->landlord_id = Arr::get($this->propertyData, 'landlord_id');
        $this->tenant_id = Arr::get($this->propertyData, 'tenant_id');
        $this->building_manager_id = Arr::get($this->propertyData, 'building_manager_id');
        $this->electricity_supplier_id = Arr::get($this->propertyData, 'electricity_supplier_id');
    }

}


