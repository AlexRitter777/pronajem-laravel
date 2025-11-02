<?php

namespace App\Actions\Tenant;

use App\Dto\Tenant\TenantData;
use App\Models\Tenant;
use App\Models\User;

class StoreTenantAction
{
    public function __construct(){}
    public function execute(TenantData $data, User $user){
        return Tenant::create([
            'name' => $data->name,
            'address' => $data->address,
            'email' => $data->email,
            'birthday' => $data->birthday,
            'phone' => $data->phone,
            'account_number' => $data->account,
            'user_id' => $user->id
        ]);
    }
}
