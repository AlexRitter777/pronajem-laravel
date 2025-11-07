<?php

namespace App\Dto\BuildingManager;

use Illuminate\Support\Arr;

readonly class BuildingManagerData
{

    public string $name;
    public ?string $phone;
    public ?string $email;

    public function __construct(public readonly array $buildingManagerData)
    {
        $this->name = Arr::get($buildingManagerData, 'name');
        $this->phone = Arr::get($buildingManagerData, 'phone');
        $this->email = Arr::get($buildingManagerData, 'email');
    }



}
