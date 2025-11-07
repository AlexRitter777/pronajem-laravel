<?php

namespace App\Actions\BuildingManager;

use App\Dto\BuildingManager\BuildingManagerData;
use App\Models\User;

class UpdateBuildingManagerAction
{
    public function __construct(protected GetBuildingManagerAction $getBuildingManagerAction){}

    public function execute(BuildingManagerData $data, string $id , User $user) : bool

    {

        $buildingManager = $this->getBuildingManagerAction->execute($id, $user);

        return $buildingManager->update([
            'name' => $data->name,
            'phone' => $data->phone,
            'email' => $data->email,
            'user_id' => $user->id
        ]);

    }
}
