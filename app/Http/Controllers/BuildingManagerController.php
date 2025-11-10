<?php

namespace App\Http\Controllers;

use App\Actions\BuildingManager\DeleteBuildingManagerAction;
use App\Actions\BuildingManager\GetBuildingManagerAction;
use App\Actions\BuildingManager\StoreBuildingManagerAction;
use App\Actions\BuildingManager\UpdateBuildingManagerAction;
use App\Dto\BuildingManager\BuildingManagerData;
use App\Http\Requests\StoreBuildingManagerRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BuildingManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('buildingManager.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buildingManager.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBuildingManagerRequest $request, StoreBuildingManagerAction $storeBuildingManagerAction)
    {
        $validated = $request->validated();
        $user = $request->user();
        $buildingManger = $storeBuildingManagerAction->execute(new BuildingManagerData($validated), $user);

        return redirect()
            ->route('building-managers.show', $buildingManger->id)
            ->with('success', __('Building manager has been created.'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, GetBuildingManagerAction $getBuildingManagerAction)
    {
        $user = auth()->user();
        try {
            $buildingManager = $getBuildingManagerAction->execute($id, $user);
            return view('buildingManager.show', ['buildingManager' => $buildingManager]);
        }catch (ModelNotFoundException $e) {
            return redirect()
                ->route('building-managers.index')
                ->with('error', __('Building manager not found.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, GetBuildingManagerAction $getBuildingManagerAction)
    {
        $user = auth()->user();
        try {
            $buildingManager = $getBuildingManagerAction->execute($id, $user);
            return view('buildingManager.edit', ['buildingManager' => $buildingManager]);
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('building-managers.index')
                ->with('error', __('Building manager not found.'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBuildingManagerRequest $request, string $id, UpdateBuildingManagerAction $updateBuildingManagerAction)
    {
        $validated = $request->validated();
        $user = $request->user();

        try {
            $buildingManager = $updateBuildingManagerAction->execute(new BuildingManagerData($validated), $id, $user);
            return redirect()
                ->back()
                ->with('success', __('Building manager has been updated.'));
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('building-managers.index')
                ->with('error', __('Building manager not found.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DeleteBuildingManagerAction $deleteBuildingManagerAction)
    {
        $user = auth()->user();

        try {
            $deleteBuildingManagerAction->execute($id, $user);
            return redirect()
                ->route('building-managers.index')
                ->with('success', __('Building manager has been deleted.'));
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('building-managers.index')
                ->with('error', __('Building manager not found.'));
        }
    }
}
