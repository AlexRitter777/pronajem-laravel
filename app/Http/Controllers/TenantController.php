<?php

namespace App\Http\Controllers;

use App\Actions\Tenant\GetTenantAction;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tenant.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, GetTenantAction $getTenantAction)
    {
        try {
            $tenant = $getTenantAction->execute($id);
        }catch (\Throwable $e){
            return redirect()->route('tenant.index')->with('error', 'Nájemník nebyl nalezen.');
        }

        return view('tenant.show', ['tenant' => $tenant]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
        //
    }
}
