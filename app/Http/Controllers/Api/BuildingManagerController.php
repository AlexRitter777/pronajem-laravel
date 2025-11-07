<?php

namespace App\Http\Controllers\Api;

use App\Actions\BuildingManager\ListBuildingManagerAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingManagerResource;
use Illuminate\Http\Request;

class BuildingManagerController extends Controller
{
    public function index(Request $request, ListBuildingManagerAction $listBuildingManagerAction){

        $buildingManagers = $listBuildingManagerAction->execute($request->user(), $request->only('search', 'sort', 'order', 'per_page'));
        return BuildingManagerResource::collection($buildingManagers);
    }
}
