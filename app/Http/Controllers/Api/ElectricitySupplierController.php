<?php

namespace App\Http\Controllers\Api;

use App\Actions\ElectricitySupplier\ListElectricitySupplierAction;
use App\Actions\ElectricitySupplier\StoreElectricitySupplierAction;
use App\Dto\ElectricitySupplier\ElectricitySupplierData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreElectricitySupplierRequest;
use App\Http\Resources\ElectricitySupplierResource;
use Illuminate\Http\Request;

class ElectricitySupplierController extends Controller
{
    public function index(Request $request, ListElectricitySupplierAction $listElectricitySupplierAction)
    {

        $electricitySuppliers = $listElectricitySupplierAction->execute($request->user(), $request->only('search', 'sort', 'order', 'per_page'));
        return ElectricitySupplierResource::collection($electricitySuppliers);

    }

    public function store(StoreElectricitySupplierRequest $request, StoreElectricitySupplierAction $action)
    {
        $electricitySupplier = $action->execute(new ElectricitySupplierData($request->validated()), $request->user());
        return new ElectricitySupplierResource($electricitySupplier);
    }
}
