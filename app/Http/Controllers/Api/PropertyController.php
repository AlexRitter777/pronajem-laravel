<?php

namespace App\Http\Controllers\Api;

use App\Actions\Property\ListPropertyAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyResource;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request, ListPropertyAction $action){

        $properties = $action->execute($request->user(), $request->only(['search', 'sort', 'order', 'per_page']));

        return PropertyResource::collection($properties);

    }

}
