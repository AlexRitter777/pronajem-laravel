<?php

namespace App\Http\Controllers;

use App\Actions\Property\GetPropertyAction;
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
            return view('properties.edit', compact('property'));
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('properties.index')
                ->with('error', __('Property was not found.'));
        }


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
