<?php

namespace App\Actions\ElectricitySupplier;

use App\Models\ElectricitySupplier;
use App\Models\User;

class DeleteElectricitySupplierAction
{

    public function execute(string $id, User $user)
    {
        $electricitySupplier = ElectricitySupplier::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        return $electricitySupplier->delete();
    }


}
