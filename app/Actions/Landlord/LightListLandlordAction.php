<?php

namespace App\Actions\Landlord;

use App\Actions\Base\LightListUserOwnedModelAction;
use App\Models\Landlord;

class LightListLandlordAction extends LightListUserOwnedModelAction
{
    protected function model(): string
    {
        return Landlord::class;
    }
}
