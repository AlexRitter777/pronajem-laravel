<?php

namespace App\Http\Controllers\Api;

use App\Actions\Landlord\LightListLandlordAction;
use App\Actions\Landlord\ListLandlordAction;
use App\Actions\Landlord\StoreLandlordAction;
use App\Dto\Landlord\LandlordData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLandlordRequest;
use App\Http\Resources\LandlordResource;
use App\Http\Resources\LightListLandlordResource;
use Illuminate\Http\Request;

class LandlordController extends Controller
{
    public function index(Request $request, ListLandlordAction $listLandlordAction)
    {

        $landlords  = $listLandlordAction->execute($request->user(), $request->only(['search', 'sort', 'order', 'per_page']));
        return LandlordResource::collection($landlords);
    }


    public function getSelectList(Request $request, LightListLandlordAction $listLandlordAction)
    {

        $landlords = $listLandlordAction->execute($request->user());

        return LightListLandlordResource::collection($landlords);

    }

    public function store(StoreLandlordRequest $request, StoreLandlordAction $action)
    {


        $landlord = $action->execute(new LandlordData($request->validated()), request()->user());

        return new LandlordResource($landlord);
    }

}
