<?php

use App\Http\Controllers\Api\TenantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');


    Route::get('najemnici', [TenantController::class, 'index'])->name('api.tenants.list');
    Route::delete('najemnici/{id}', [TenantController::class, 'destroy'])->name('api.tenants.destroy');



