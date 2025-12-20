<?php

namespace App\Http\Controllers\Api;

use App\Actions\Tenant\LightListTenantAction;
use App\Actions\Tenant\ListTenantAction;
use App\Actions\Tenant\StoreTenantAction;
use App\Dto\Tenant\TenantData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenantRequest;
use App\Http\Resources\LightListTenantResource;
use App\Http\Resources\TenantResource;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ListTenantAction $listTenantAction)
    {

        $tenants = $listTenantAction->execute($request->user(), $request->only(['search', 'sort', 'order', 'per_page']));
        return TenantResource::collection($tenants);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTenantRequest $request, StoreTenantAction $action)
    {
        $tenant = $action->execute(new TenantData($request->validated()), $request->user());
        return new TenantResource($tenant);
    }


    public function getSelectList(Request $request, LightListTenantAction $action)
    {
        $tenants = $action->execute($request->user());

        return LightListTenantResource::collection($tenants);

    }
}
