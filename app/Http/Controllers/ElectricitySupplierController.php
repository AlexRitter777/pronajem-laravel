<?php

namespace App\Http\Controllers;

use App\Actions\ElectricitySupplier\DeleteElectricitySupplierAction;
use App\Actions\ElectricitySupplier\GetElectricitySupplierAction;
use App\Actions\ElectricitySupplier\StoreElectricitySupplierAction;
use App\Actions\ElectricitySupplier\UpdateElectricitySupplierAction;
use App\Dto\ElectricitySupplier\ElectricitySupplierData;
use App\Http\Requests\StoreElectricitySupplierRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ElectricitySupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('electricitySupplier.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('electricitySupplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreElectricitySupplierRequest $request, StoreElectricitySupplierAction $storeElectricitySupplierAction)
    {
        $validated = $request->validated();
        $user = $request->user();
        $electricitySupplier = $storeElectricitySupplierAction->execute(new ElectricitySupplierData($validated), $user);

        return redirect()
            ->route('electricity-suppliers.show', $electricitySupplier->id)
            ->with('success', __('Electricity Supplier successfully created.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, GetElectricitySupplierAction $getElectricitySupplierAction)
    {
        $user = auth()->user();
        try {
            $electricitySupplier = $getElectricitySupplierAction->execute($id, $user);
            return view('electricitySupplier.show', compact('electricitySupplier'));
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('electricity-suppliers.index')
                ->with('error', __('Electricity Supplier not found.'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, GetElectricitySupplierAction $getElectricitySupplierAction)
    {
        $user = auth()->user();

        try {
            $electricitySupplier = $getElectricitySupplierAction->execute($id, $user);
            return view('electricitySupplier.edit', compact('electricitySupplier'));
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('electricity-suppliers.index')
                ->with('error', __('Electricity Supplier not found.'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreElectricitySupplierRequest $request, string $id, UpdateElectricitySupplierAction $updateElectricitySupplierAction)
    {

        $validated = $request->validated();
        $user = $request->user();

        try {
            $electricitySupplier = $updateElectricitySupplierAction->execute(new ElectricitySupplierData($validated), $id, $user);
            return redirect()
                ->back()
                ->with('success', __('Electricity Supplier has been updated.'));
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('electricity-suppliers.index')
                ->with('error', __('Electricity Supplier not found.'));
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DeleteElectricitySupplierAction $deleteElectricitySupplierAction)
    {
        $user = auth()->user();

        try {
            $deleteElectricitySupplierAction->execute($id, $user);
            return redirect()
                ->route('electricity-suppliers.index')
                ->with('success', __('Electricity Supplier has been deleted.'));
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('electricity-suppliers.index')
                ->with('error', __('Electricity Supplier not found.'));
        }

    }
}
