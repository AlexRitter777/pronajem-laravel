<?php

namespace App\Actions\BuildingManager;

use App\Actions\Base\GetUserOwnedModelAction;
use App\Models\BuildingManager;

class GetBuildingManagerAction extends GetUserOwnedModelAction
{

    protected function model(): string
    {
        return BuildingManager::class;
    }

    protected function withRelations(): array
    {
        return ['properties'];
    }
}
