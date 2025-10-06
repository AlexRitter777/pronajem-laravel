<?php

namespace App\Actions\Tenant;

use App\Models\Tenant;

class ListTenantAction
{
    public function execute(array $filters = [])
    {

        return Tenant::orderBy('id','desc')->paginate(3);


    }

}


