<?php

namespace App\Actions\BuildingManager;

use App\Actions\Base\UpdateUserOwnedModelAction;
use App\Models\BuildingManager;

class UpdateBuildingManagerAction extends UpdateUserOwnedModelAction
{
    protected function model(): string
    {
        return BuildingManager::class;
    }

    protected function toArray(object $data): array
    {
        return [
            'name' => $data->name,
            'phone' => $data->phone,
            'email' => $data->email,
        ];
    }
}
