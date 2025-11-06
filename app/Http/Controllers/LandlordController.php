<?php

namespace App\Http\Controllers;

use App\Actions\Landlord\DeleteLandlordAction;
use App\Actions\Landlord\GetLandlordAction;
use App\Actions\Landlord\StoreLandlordAction;
use App\Actions\Landlord\UpdateLandlordAction;
use App\Dto\Landlord\LandlordData;
use App\Http\Requests\StoreLandlordRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LandlordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('landlords.index');
    }

    public function create()
    {
        return view('landlords.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLandlordRequest $request, StoreLandlordAction $storeLandlordAction)
    {
        $validated = $request->validated();
        $user = $request->user();
        $landlord = $storeLandlordAction->execute(new LandlordData($validated), $user);

        return redirect()
            ->route('landlords.show', ['landlord' => $landlord->id])
            ->with('success', __('Landlord has been created.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, GetLandlordAction $getLandlordAction)
    {
        $user = auth()->user();
        try {
            $landlord = $getLandlordAction->execute($id, $user);
            return view('landlords.show', ['landlord' => $landlord]);
        }catch (ModelNotFoundException $e){
            return redirect()
                ->route('landlords.index')
                ->with('error', __('Landlord was not found.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, GetLandlordAction $getLandlordAction)
    {
        $user = auth()->user();
        try {
            $landlord = $getLandlordAction->execute($id, $user);
            return view('landlords.edit', ['landlord' => $landlord]);
        }catch (ModelNotFoundException $e){
            return redirect()
                ->route('landlords.index')
                ->with('error', __('Landlord was not found.'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreLandlordRequest $request, string $id, UpdateLandlordAction $updateLandlordAction)
    {
        $validated = $request->validated();

        $user = $request->user();

        try {
            $updateLandlordAction->execute(new LandlordData($validated), $id,  $user);
            return redirect()
                ->back()
                ->with('success', __('Landlord has been updated.'));

        }catch (ModelNotFoundException $e){
            return redirect()
                ->route('landlords.index')
                ->with('error', __('Landlord was not found.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DeleteLandlordAction $deleteLandlordAction)
    {
        $user = auth()->user();

        try {
            $deleteLandlordAction->execute($id, $user);
            return redirect()
                ->route('landlords.index')
                ->with('success', __('Landlord has been deleted.'));
        } catch (ModelNotFoundException $e){
            return redirect()
                ->route('landlords.index')
                ->with('error', __('Landlord was not found.'));
        }
    }
}
