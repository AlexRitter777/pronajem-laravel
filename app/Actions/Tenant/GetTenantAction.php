<?php

namespace App\Actions\Tenant;

use App\Models\Tenant;
use App\Models\User;

class GetTenantAction
{

    public function execute(string $tenantId, User $user){

         return Tenant::where('id', $tenantId)
             ->where('user_id', $user->id)
             ->firstOrFail();

    }

}
