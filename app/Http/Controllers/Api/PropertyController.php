<?php

namespace App\Http\Controllers\Api;

use App\Actions\Property\LightListPropertyAction;
use App\Actions\Property\ListPropertyAction;
use App\Actions\Property\StorePropertyAction;
use App\Dto\Property\PropertyData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Resources\LightListPropertyResource;
use App\Http\Resources\PropertyResource;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request, ListPropertyAction $action){

        $properties = $action->execute($request->user(), $request->only(['search', 'sort', 'order', 'per_page']));

        return PropertyResource::collection($properties);

    }

    public function getSelectList(Request $request, LightListPropertyAction $action)
    {
        $properties = $action->execute($request->user());

        return LightListPropertyResource::collection($properties);
    }

    public function store(StorePropertyRequest $request, StorePropertyAction $action)
    {
        $property = $action->execute(new PropertyData($request->validated()), $request->user());

        return new PropertyResource($property);

    }

}
