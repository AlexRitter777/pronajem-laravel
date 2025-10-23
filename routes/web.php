<?php

use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::resourceVerbs([
    'create' => 'novy',
    'edit' => 'upravit',
    'store' => 'ulozit',
    'update' => 'ulozit',
    'destroy' => 'smazat',
]);

Route::resource('najemnici', TenantController::class)->names('tenants');
