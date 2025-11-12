<?php

namespace App\Actions\ElectricitySupplier;

use App\Actions\Base\ListUserOwnedModelAction;
use App\Models\ElectricitySupplier;
use App\Models\User;

class ListElectricitySupplierAction extends ListUserOwnedModelAction
{

    protected function model() : string
    {
        return ElectricitySupplier::class;
    }

    protected function withRelations(): array
    {
        return ['properties'];
    }

    protected function searchColumns(): array
    {
        return ['name'];
    }

}
