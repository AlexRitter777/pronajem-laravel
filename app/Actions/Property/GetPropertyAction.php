<?php

namespace App\Actions\Property;


use App\Actions\Base\GetUserOwnedModelAction;
use App\Models\Property;
use App\Models\User;

class GetPropertyAction extends GetUserOwnedModelAction
{


    protected function model(): string
    {
        return Property::class;
    }

    protected function withRelations(): array
    {
        return [
            'tenant',
            'landlord',
            'buildingManager',
            'electricitySupplier'
        ];
    }



}
