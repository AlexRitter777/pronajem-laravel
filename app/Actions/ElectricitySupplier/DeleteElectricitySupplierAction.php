<?php

namespace App\Actions\ElectricitySupplier;

use App\Actions\Base\DeleteUserOwnedModelAction;
use App\Models\ElectricitySupplier;
use App\Models\User;

class DeleteElectricitySupplierAction extends DeleteUserOwnedModelAction
{

    protected function model(): string
    {
        return ElectricitySupplier::class;
    }

}
