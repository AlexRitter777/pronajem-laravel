<?php

namespace App\Http\Controllers\Api;

use App\Actions\ElectricitySupplier\ListElectricitySupplierAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\ElectricitySupplierResource;
use Illuminate\Http\Request;

class ElectricitySupplierController extends Controller
{
    public function index(Request $request, ListElectricitySupplierAction $listElectricitySupplierAction)
    {

        $electricitySuppliers = $listElectricitySupplierAction->execute($request->user(), $request->only('search', 'sort', 'order', 'per_page'));
        return ElectricitySupplierResource::collection($electricitySuppliers);

    }
}
