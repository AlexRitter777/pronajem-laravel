<?php

namespace App\Dto\ElectricitySupplier;

use Illuminate\Support\Arr;

readonly class ElectricitySupplierData
{

    public string $name;
    public ?string $description;

    public function __construct(public readonly array $electricitySupplierData)
    {
        $this->name = Arr::get($electricitySupplierData, 'name');
        $this->description = Arr::get($electricitySupplierData, 'description');
    }



}
