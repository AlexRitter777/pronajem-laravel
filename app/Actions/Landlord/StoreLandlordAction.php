<?php

namespace App\Actions\Landlord;

use App\Actions\Base\StoreUserOwnedModelAction;
use App\Models\Landlord;

class StoreLandlordAction extends  StoreUserOwnedModelAction
{

    protected function model(): string
    {
        return Landlord::class;
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
