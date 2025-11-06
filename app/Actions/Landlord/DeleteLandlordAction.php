<?php

namespace App\Actions\Landlord;

use App\Models\Landlord;
use App\Models\User;

class DeleteLandlordAction
{

    public function execute(string $landlordId, User $user)
    {
        $landlord = Landlord::where('id', $landlordId)
            ->where('user_id', $user->id)
            ->firstOrFail();

        return $landlord->delete();
    }


}
