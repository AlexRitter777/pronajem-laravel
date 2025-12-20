<?php

namespace App\Actions\BuildingManager;

use App\Actions\Base\LightListUserOwnedModelAction;
use App\Models\BuildingManager;

final class LightListBuildingManagerAction extends LightListUserOwnedModelAction
{

    protected function model(): string
    {
        return BuildingManager::class;
    }


}
