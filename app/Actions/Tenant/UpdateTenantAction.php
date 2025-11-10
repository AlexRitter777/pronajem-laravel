<?php

namespace App\Actions\Tenant;

use App\Dto\Tenant\TenantData;
use App\Models\User;

class UpdateTenantAction
{
    public function __construct(protected GetTenantAction $getTenantAction){}

    public function execute(TenantData $data, string $tenantId , User $user) : bool

    {

        $tenant = $this->getTenantAction->execute($tenantId, $user);

        return $tenant->update([
            'name' => $data->name,
            'address' => $data->address,
            'email' => $data->email,
            'birthday' => $data->birthday,
            'phone' => $data->phone,
            'account_number' => $data->account_number,
            'user_id' => $user->id
        ]);

    }
}
