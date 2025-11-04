<?php

namespace App\Http\Controllers;

use App\Actions\Tenant\DeleteTenantAction;
use App\Actions\Tenant\GetTenantAction;
use App\Actions\Tenant\StoreTenantAction;
use App\Actions\Tenant\UpdateTenantAction;
use App\Dto\Tenant\TenantData;
use App\Http\Requests\StoreTenantRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $user = $request->user();
        $tenant = $storeTenantAction->execute(new TenantData($validated), $user);

        return redirect()
            ->route('tenants.show', ['tenant' => $tenant->id])
            ->with('success', __('Tenant has been created.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, GetTenantAction $getTenantAction)
    {
        $user = auth()->user();
        try {
            $tenant = $getTenantAction->execute($id, $user);
            return view('tenants.show', ['tenant' => $tenant]);
        }catch (ModelNotFoundException $e){
            return redirect()
                ->route('tenants.index')
                ->with('error', __('Tenant was not found.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, GetTenantAction $getTenantAction)
    {
        $user = auth()->user();
        try {
            $tenant = $getTenantAction->execute($id, $user);
            return view('tenants.edit', ['tenant' => $tenant]);
        }catch (ModelNotFoundException $e){
            return redirect()
                ->route('tenants.index')
                ->with('error', __('Tenant was not found.'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTenantRequest $request, string $id, UpdateTenantAction $updateTenantAction)
    {
        $validated = $request->validated();

        $user = $request->user();

        try {
            $updateTenantAction->execute(new TenantData($validated), $id,  $user);
            return redirect()
                ->back()
                ->with('success', __('Tenant has been updated.'));

        }catch (ModelNotFoundException $e){
            return redirect()
                ->route('tenants.index')
                ->with('error', __('Tenant was not found.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DeleteTenantAction $deleteTenantAction)
    {
        $user = auth()->user();

        try {
            $deleteTenantAction->execute($id, $user);
            return redirect()
                ->route('tenants.index')
                ->with('success', __('Tenant has been deleted.'));
        } catch (ModelNotFoundException $e){
            return redirect()
                ->route('tenants.index')
                ->with('error', __('Tenant was not found.'));
        }
    }
}
