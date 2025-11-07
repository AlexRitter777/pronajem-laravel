<?php

namespace App\Actions\BuildingManager;

use App\Models\BuildingManager;
use App\Models\User;

class DeleteBuildingManagerAction
{

    public function execute(string $id, User $user)
    {
        $buildingManager = BuildingManager::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        return $buildingManager->delete();
    }


}
