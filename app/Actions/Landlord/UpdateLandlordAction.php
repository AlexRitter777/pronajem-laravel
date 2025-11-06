<?php

namespace App\Actions\Landlord;

use App\Dto\Landlord\LandlordData;
use App\Models\User;

class UpdateLandlordAction
{
    public function __construct(protected GetLandlordAction $getLandlordAction){}

    public function execute(LandlordData $data, string $landlordId , User $user) : bool

    {

        $landlord = $this->getLandlordAction->execute($landlordId, $user);

        return $landlord->update([
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
