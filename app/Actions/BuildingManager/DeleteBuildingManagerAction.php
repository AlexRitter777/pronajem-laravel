<?php

namespace App\Actions\BuildingManager;

use App\Actions\Base\DeleteUserOwnedModelAction;
use App\Models\BuildingManager;

class DeleteBuildingManagerAction extends DeleteUserOwnedModelAction
{
    protected function model(): string
    {
        return BuildingManager::class;
    }
}
