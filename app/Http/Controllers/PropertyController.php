<?php

namespace App\Http\Controllers;

use App\Actions\Property\GetPropertyAction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(){}


    public function show(string $Id, GetPropertyAction $getPropertyAction)
    {
        $user = auth()->user();
        try {
            $property = $getPropertyAction->execute($Id, $user);
            return view('property.show', compact('property'));
        } catch (ModelNotFoundException $e) {
            abort(404); //chandge later
        }
    }

}
