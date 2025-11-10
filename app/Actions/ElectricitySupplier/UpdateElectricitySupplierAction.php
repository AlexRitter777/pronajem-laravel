<?php

namespace App\Actions\ElectricitySupplier;

use App\Dto\ElectricitySupplier\ElectricitySupplierData;
use App\Models\User;

class UpdateElectricitySupplierAction
{
    public function __construct(protected GetElectricitySupplierAction $getElectricitySupplierAction){}

    public function execute(ElectricitySupplierData $data, string $id , User $user) : bool

    {

        $electricitySupplier = $this->getElectricitySupplierAction->execute($id, $user);

        return $electricitySupplier->update([
            'name' => $data->name,
            'description' => $data->description,
            'user_id' => $user->id
        ]);

    }
}
