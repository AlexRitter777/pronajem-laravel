<?php

namespace App\Actions\ElectricitySupplier;

use App\Actions\Base\LightListUserOwnedModelAction;
use App\Models\ElectricitySupplier;

class LightListElectricitySupplierAction extends LightListUserOwnedModelAction
{
    protected function model(): string
    {
        return ElectricitySupplier::class;
    }
}
