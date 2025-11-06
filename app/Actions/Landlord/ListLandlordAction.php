<?php

namespace App\Actions\Landlord;

use App\Models\Landlord;
use App\Models\User;

class ListLandlordAction
{

    public function execute(User $user, array $filters = [])
    {


        $perPage = $filters['per_page'] ?? 10;

        $query = Landlord::query()
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
