<?php

namespace App\Actions\Tenant;

use App\Dto\Tenant\StoreTenantData;
use App\Models\Tenant;

class StoreTenantAction
{
    public function __construct(){}
    public function execute(StoreTenantData $data){
        return Tenant::create([
            'name' => $data->name,
            'address' => $data->address,
            'email' => $data->email,
            'birthday' => $data->birthday,
            'phone' => $data->phone,
            'account_number' => $data->account,
            'user_id' => '1'
        ]);
    }
}
