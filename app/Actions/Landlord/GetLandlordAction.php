<?php

namespace App\Actions\Landlord;

use App\Models\Landlord;
use App\Models\User;

class GetLandlordAction
{

    public function execute(string $landlordId, User $user){

         return Landlord::where('id', $landlordId)
             ->where('user_id', $user->id)
             ->with('properties')
             ->firstOrFail();

    }

}
