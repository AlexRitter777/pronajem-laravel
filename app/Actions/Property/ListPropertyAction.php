<?php

namespace App\Actions\Property;

use App\Actions\Base\ListUserOwnedModelAction;
use App\Models\Property;

class ListPropertyAction extends ListUserOwnedModelAction
{

    protected function model() : string
    {
        return Property::class;
    }

    protected function withRelations() : array
    {
        return [
            'tenant',
        ];
    }


    protected function searchColumns(): array
    {
        return ['address'];
    }

}
