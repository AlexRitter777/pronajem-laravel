<?php

namespace App\Actions\ElectricitySupplier;

use App\Actions\Base\StoreUserOwnedModelAction;
use App\Models\ElectricitySupplier;

class StoreElectricitySupplierAction extends StoreUserOwnedModelAction
{
    protected function model() : string
    {
        return ElectricitySupplier::class;
    }

    protected function toArray(object $data) : array
    {
        return [
            'name' => $data->name,
            'description' => $data->description,
        ];
    }

}
