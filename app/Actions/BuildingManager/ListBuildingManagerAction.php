<?php

namespace App\Actions\BuildingManager;

use App\Actions\Base\ListUserOwnedModelAction;
use App\Models\BuildingManager;
use App\Models\User;

class ListBuildingManagerAction extends ListUserOwnedModelAction
{

    protected function model() : string
    {
        return BuildingManager::class;
    }

    protected function withRelations(): array
    {
        return ['properties'];
    }

    protected function searchColumns(): array
    {
        return ['name'];
    }

}
