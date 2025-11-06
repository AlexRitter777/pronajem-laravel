<?php

namespace App\Actions\Landlord;

use App\Dto\Landlord\LandlordData;
use App\Models\Landlord;
use App\Models\User;

class StoreLandlordAction
{
    public function __construct(){}
    public function execute(LandlordData $data, User $user){
        return Landlord::create([
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
