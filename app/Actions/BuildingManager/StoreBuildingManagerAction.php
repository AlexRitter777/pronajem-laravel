<?php

namespace App\Actions\BuildingManager;

use App\Dto\BuildingManager\BuildingManagerData;
use App\Models\BuildingManager;
use App\Models\User;

class StoreBuildingManagerAction
{
    public function __construct(){}
    public function execute(BuildingManagerData $data, User $user){
        return BuildingManager::create([
            'name' => $data->name,
            'phone' => $data->phone,
            'email' => $data->email,
            'user_id' => $user->id
        ]);
    }
}
