<?php

namespace App\Actions\ElectricitySupplier;

use App\Actions\Base\UpdateUserOwnedModelAction;
use App\Models\ElectricitySupplier;

class UpdateElectricitySupplierAction extends UpdateUserOwnedModelAction
{
    protected function model(): string
    {
        return ElectricitySupplier::class;
    }

    protected function toArray(object $data): array
    {
        return [
            'name' => $data->name,
            'description' => $data->description,
        ];
    }
}
