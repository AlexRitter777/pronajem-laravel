<?php

namespace App\Actions\BuildingManager;

use App\Actions\Base\StoreUserOwnedModelAction;
use App\Dto\BuildingManager\BuildingManagerData;
use App\Models\BuildingManager;

class StoreBuildingManagerAction extends StoreUserOwnedModelAction
{
    protected function model() : string
    {
        return BuildingManager::class;
    }

    protected function toArray(object $data) : array
    {
        return [
            'name' => $data->name,
            'phone' => $data->phone,
            'email' => $data->email,
        ];
    }

}
