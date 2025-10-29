<?php

namespace App\Http\Controllers;

use App\Actions\Tenant\GetTenantAction;
use App\Actions\Tenant\StoreTenantAction;
use App\Dto\Tenant\TenantData;
use App\Http\Requests\StoreTenantRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tenants.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTenantRequest $request, StoreTenantAction $storeTenantAction)
    {
        $validated = $request->validated();
        $tenant = $storeTenantAction->execute(new TenantData($validated));

        return redirect()->route('tenants.show', ['tenant' => $tenant->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, GetTenantAction $getTenantAction)
    {
        try {
            $tenant = $getTenantAction->execute($id);
            return view('tenants.show', ['tenant' => $tenant]);
        }catch (ModelNotFoundException $e){
            return redirect()
                ->route('tenants.index')
                ->with('error', 'Nájemník nebyl nalezen.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, GetTenantAction $getTenantAction)
    {

        try {
            $tenant = $getTenantAction->execute($id);
        }catch (\Throwable $e){
            return redirect()->route('tenants.index')->with('error', 'Nájemník nebyl nalezen.');
        }

        return view('tenants.edit', ['tenant' => $tenant]);
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
        //
    }
}
