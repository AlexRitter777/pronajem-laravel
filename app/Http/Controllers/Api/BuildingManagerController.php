<?php

namespace App\Http\Controllers\Api;

use App\Actions\BuildingManager\LightListBuildingManagerAction;
use App\Actions\BuildingManager\ListBuildingManagerAction;
use App\Actions\BuildingManager\StoreBuildingManagerAction;
use App\Dto\BuildingManager\BuildingManagerData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBuildingManagerRequest;
use App\Http\Resources\BuildingManagerResource;
use App\Http\Resources\LightListBuildingManagerResource;
use Illuminate\Http\Request;

class BuildingManagerController extends Controller
{
    public function index(Request $request, ListBuildingManagerAction $listBuildingManagerAction){

        $buildingManagers = $listBuildingManagerAction->execute($request->user(), $request->only('search', 'sort', 'order', 'per_page'));
        return BuildingManagerResource::collection($buildingManagers);
    }

    public function store(StoreBuildingManagerRequest $request, StoreBuildingManagerAction $action)
    {
        $buildingManager = $action->execute(new BuildingManagerData($request->validated()), $request->user());
        return new BuildingManagerResource($buildingManager);
    }

    public function getSelectList(Request $request, LightListBuildingManagerAction $action)
    {
        $buildingManagers = $action->execute($request->user());

        return LightListBuildingManagerResource::collection($buildingManagers);

    }

}
