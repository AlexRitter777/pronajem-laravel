<?php

use App\Http\Controllers\BuildingManagerController;
use App\Http\Controllers\ElectricitySupplierController;
use App\Http\Controllers\LandlordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\Api\TenantController as ApiTenantController;
use App\Http\Controllers\Api\LandlordController as ApiLandlordController;
use App\Http\Controllers\Api\BuildingManagerController as ApiBuildingManagerController;
use App\Http\Controllers\Api\ElectricitySupplierController as ApiElectricitySupplierController;
use App\Http\Controllers\Api\PropertyController as ApiPropertyController;
use App\Models\User;
use Illuminate\Support\Facades\Route;



Route::get('/' . __('dashboard'), function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::resourceVerbs([
    'create' => __('create'),
    'edit' => __('edit'),
]);


Route::get('/test-mail/welcome', function () {
    $user = User::first() ?? new User([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);

    return new App\Mail\WelcomeMail($user)->render();


});


Route::get('/test-mail/password', function () {
    $user = User::first() ?? new User([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);

    return new App\Mail\PasswordResetMail($user)->render();


});


Route::middleware('auth')->group(function () {

    //ToDo: Change this API route to translation
    Route::get('api/najemnici', [ApiTenantController::class, 'index'])->name('api.tenants.list');
    Route::post('api/' . __('tenants'), [ApiTenantController::class, 'store'])->name('api.tenants.store');
    Route::get('api/' . __('landlords'), [ApiLandlordController::class, 'index'])->name('api.landlords.list');
    Route::post('api/' . __('landlords'), [ApiLandlordController::class, 'store'])->name('api.landlords.store');
    Route::get('api/' . __('building-managers'), [ApiBuildingManagerController::class, 'index'])->name('api.building-managers.list');
    Route::post('api/' . __('building-managers'), [ApiBuildingManagerController::class, 'store'])->name('api.building-managers.store');
    Route::get('api/' . __('electricity-suppliers'), [ApiElectricitySupplierController::class, 'index'])->name('api.electricity-suppliers.list');
    Route::post('api/' . __('electricity-suppliers'), [ApiElectricitySupplierController::class, 'store'])->name('api.electricity-suppliers.store');
    Route::get('api/' . __('properties'), [ApiPropertyController::class, 'index'])->name('api.properties.list');
    Route::get('api/' . __('landlords-list'), [ApiLandlordController::class, 'getSelectList'])->name('api.landlords.light.list');
    Route::get('api/' . __('tenants-list'), [ApiTenantController::class, 'getSelectList'])->name('api.tenants.light.list');
    Route::get('api/' . __('electricity-suppliers-list'), [ApiElectricitySupplierController::class, 'getSelectList'])->name('api.electricity-suppliers.light.list');
    Route::get('api/' . __('building-managers-list'), [ApiBuildingManagerController::class, 'getSelectList'])->name('api.building-managers.light.list');


    Route::resource(__('tenants'), TenantController::class)
        ->parameters([__('tenants') => 'tenant'])
        ->names('tenants');

    Route::resource(__('landlords'), LandlordController::class)
        ->parameters([__('landlords') => 'landlord'])
        ->names('landlords');

    Route::resource(__('building-managers'), BuildingManagerController::class)
        ->parameters([__('building-managers') => 'buildingManager'])
        ->names('building-managers');

    Route::resource(__('electricity-suppliers'), ElectricitySupplierController::class)
        ->parameters([__('electricity-suppliers') => 'electricitySupplier'])
        ->names('electricity-suppliers');

    Route::resource(__('properties'), PropertyController::class)
        ->parameters([__('properties') => 'property'])
        ->names('properties');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
