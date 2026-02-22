<?php

namespace App\Actions\Property;

use App\Actions\Base\LightListUserOwnedModelAction;
use App\Models\Property;

class LightListPropertyAction extends LightListUserOwnedModelAction
{

    protected function model(): string
    {
        return Property::class;
    }

    protected function withRelations() : array
    {
        return [
            'tenant',
            'landlord'
        ];

    }

}
