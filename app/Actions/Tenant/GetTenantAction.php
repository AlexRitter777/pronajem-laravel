<?php

namespace App\Actions\Tenant;

use App\Models\Tenant;

class GetTenantAction
{

    public function execute(string $id){

        return Tenant::find($id)->firstOrFail();

    }

}
