<?php

namespace App\Http\Controllers;

use App\Actions\Property\GetPropertyAction;
use App\Actions\Property\UpdatePropertyAction;
use App\Dto\Property\PropertyData;
use App\Http\Requests\StorePropertyRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('properties.index');
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
    public function show(string $id, GetPropertyAction $getPropertyAction)
    {
        $user = auth()->user();
        try {
            $property = $getPropertyAction->execute($id, $user);
            return view('properties.show', compact('property'));
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('properties.index')
                ->with('error', __('Property was not found.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, GetPropertyAction $getPropertyAction)
    {
        $user = auth()->user();
        try {
            $property = $getPropertyAction->execute($id, $user);
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('properties.index')
                ->with('error', __('Property was not found.'));
        }

        return view('properties.edit', compact('property'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePropertyRequest $request, string $id, UpdatePropertyAction $updatePropertyAction)
    {
        dd($request->all());
        $validated = $request->validated();

        $user = $request->user();

        try {
            $updatePropertyAction->execute(new PropertyData($validated), $id,  $user);
        }catch (ModelNotFoundException $e){
            return redirect()
                ->route('properties.index')
                ->with('error', __('Property was not found.'));
        }

        return redirect()
            ->back()
            ->with('success', __('Property has been updated.'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
