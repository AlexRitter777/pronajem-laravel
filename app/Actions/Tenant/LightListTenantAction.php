<?php

namespace App\Actions\Tenant;

use App\Actions\Base\LightListUserOwnedModelAction;
use App\Models\Tenant;

final class LightListTenantAction extends LightListUserOwnedModelAction
{

    protected function model(): string
    {
        return Tenant::class;
    }

}
