<?php

namespace App\Actions\Landlord;

use App\Actions\Base\GetUserOwnedModelAction;
use App\Models\Landlord;

class GetLandlordAction extends GetUserOwnedModelAction
{

    protected function model(): string
    {
        return Landlord::class;
    }

    protected function withRelations(): array
    {
        return ['properties'];
    }


}
