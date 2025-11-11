<?php

namespace App\Actions\Landlord;

use App\Actions\Base\DeleteUserOwnedModelAction;
use App\Models\Landlord;

class DeleteLandlordAction extends DeleteUserOwnedModelAction
{

        protected function model(): string
        {
            return Landlord::class;
        }
}
