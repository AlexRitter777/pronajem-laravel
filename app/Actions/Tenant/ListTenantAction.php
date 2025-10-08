<?php

namespace App\Actions\Tenant;

use App\Models\Tenant;

class ListTenantAction
{
    public function execute(array $filters = [])
    {


         $perPage = $filters['per_page'] ?? 5;

         $query = Tenant::query();

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


