<?php

namespace App\Http\Controllers\Api;

use App\Actions\Landlord\ListLandlordAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\LandlordResource;
use Illuminate\Http\Request;

class LandlordController extends Controller
{
    public function index(Request $request, ListLandlordAction $listLandlordAction)
    {

        $landlords  = $listLandlordAction->execute($request->user(), $request->only(['search', 'sort', 'order', 'per_page']));
        return LandlordResource::collection($landlords);
    }

}
