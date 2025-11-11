<?php

namespace App\Actions\Tenant;

use App\Actions\Base\UpdateUserOwnedModelAction;
use App\Models\Tenant;

class UpdateTenantAction extends UpdateUserOwnedModelAction
{
    protected function model(): string
    {
        return Tenant::class;
    }

    protected function toArray(object $data): array
    {
        return [
            'name' => $data->name,
            'address' => $data->address,
            'email' => $data->email,
            'birthday' => $data->birthday,
            'phone' => $data->phone,
            'account_number' => $data->account_number,
        ];
    }
}
