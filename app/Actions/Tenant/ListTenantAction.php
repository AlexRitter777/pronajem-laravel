<?php

namespace App\Actions\Tenant;

use App\Actions\Base\ListUserOwnedModelAction;
use App\Models\Tenant;

class ListTenantAction extends ListUserOwnedModelAction
{
    protected function model(): string
    {
        return Tenant::class;
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


