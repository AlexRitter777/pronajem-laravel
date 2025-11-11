<?php

namespace App\Actions\ElectricitySupplier;

use App\Actions\Base\GetUserOwnedModelAction;
use App\Models\ElectricitySupplier;

class GetElectricitySupplierAction extends GetUserOwnedModelAction
{

    protected function model(): string
    {
        return ElectricitySupplier::class;
    }

    protected function withRelations(): array
    {
        return ['properties'];
    }

}
