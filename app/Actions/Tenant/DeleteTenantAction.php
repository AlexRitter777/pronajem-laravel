<?php

namespace App\Actions\Tenant;

use App\Models\Tenant;
use App\Models\User;

class DeleteTenantAction
{

    public function execute(string $tenantId, User $user)
    {
        $tenant = Tenant::where('id', $tenantId)
            ->where('user_id', $user->id)
            ->firstOrFail();

        return $tenant->delete();
    }


}
