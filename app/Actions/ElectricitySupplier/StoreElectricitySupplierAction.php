<?php

namespace App\Actions\ElectricitySupplier;

use App\Dto\ElectricitySupplier\ElectricitySupplierData;
use App\Models\ElectricitySupplier;
use App\Models\User;

class StoreElectricitySupplierAction
{
    public function __construct(){}
    public function execute(ElectricitySupplierData $data, User $user){
        return ElectricitySupplier::create([
            'name' => $data->name,
            'description' => $data->description,
            'user_id' => $user->id
        ]);
    }
}
