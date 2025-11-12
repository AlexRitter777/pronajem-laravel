<?php

namespace App\Actions\Landlord;

use App\Actions\Base\ListUserOwnedModelAction;
use App\Models\Landlord;
use App\Models\User;

class ListLandlordAction extends ListUserOwnedModelAction
{

    protected function model(): string
    {
        return Landlord::class;
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
