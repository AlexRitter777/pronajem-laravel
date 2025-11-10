<?php

namespace App\Actions\ElectricitySupplier;

use App\Models\ElectricitySupplier;
use App\Models\User;

class GetElectricitySupplierAction
{

    public function execute(string $id, User $user){

         return ElectricitySupplier::where('id', $id)
             ->where('user_id', $user->id)
             ->with('properties')
             ->firstOrFail();

    }

}
