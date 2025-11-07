<?php

namespace App\Actions\BuildingManager;

use App\Models\BuildingManager;
use App\Models\User;

class GetBuildingManagerAction
{

    public function execute(string $id, User $user){

         return BuildingManager::where('id', $id)
             ->where('user_id', $user->id)
             ->with('properties')
             ->firstOrFail();

    }

}
