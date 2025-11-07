<?php

namespace App\Actions\BuildingManager;

use App\Models\BuildingManager;
use App\Models\User;

class ListBuildingManagerAction
{

    public function execute(User $user, array $filters = [])
    {


        $perPage = $filters['per_page'] ?? 10;

        $query = BuildingManager::query()
            ->where('user_id', $user->id);

        if(!empty($filters['search'])) {
            $query->where('name','like','%'.$filters['search'].'%');
        }

        if(!empty($filters['sort'])) {
            $query->orderBy($filters['sort'],$filters['order'] ?? 'desc');
        }else{
            $query->latest();
        }

        return $query->with('properties')->paginate($perPage);

    }

}
