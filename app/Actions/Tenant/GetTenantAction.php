<?php

namespace App\Actions\Tenant;

use App\Actions\Base\GetUserOwnedModelAction;
use App\Models\Tenant;

class GetTenantAction extends GetUserOwnedModelAction
{

    protected function model(): string
    {
        return Tenant::class;
    }

    protected function withRelations(): array
    {
        return ['properties'];
    }

}
