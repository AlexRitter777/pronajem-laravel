<?php

namespace App\Http\Controllers\Api;

use App\Actions\Tenant\ListTenantAction;
use App\Actions\Tenant\StoreTenantAction;
use App\Dto\Tenant\TenantData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenantRequest;
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
