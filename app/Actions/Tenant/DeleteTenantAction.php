<?php

namespace App\Actions\Tenant;

use App\Actions\Base\DeleteUserOwnedModelAction;
use App\Models\Tenant;

class DeleteTenantAction extends DeleteUserOwnedModelAction
{

    protected function model(): string
    {
        return Tenant::class;
    }

}
