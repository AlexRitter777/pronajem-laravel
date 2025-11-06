<?php

use App\Http\Controllers\LandlordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\Api\TenantController as ApiTenantController;
use App\Http\Controllers\Api\LandlordController as ApiLandlordController;
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

    Route::get('api/najemnici', [ApiTenantController::class, 'index'])->name('api.tenants.list');

    Route::get('api/' . __('landlords'), [ApiLandlordController::class, 'index'])->name('api.landlords.list');


    Route::resource(__('tenants'), TenantController::class)
        ->parameters([__('tenants') => 'tenant'])
        ->names('tenants');

    Route::resource(__('landlords'), LandlordController::class)
        ->parameters([__('landlords') => 'landlord'])
        ->names('landlords');

    Route::resource(__('properties'), PropertyController::class)
        ->parameters([__('properties') => 'property'])
        ->names('properties');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
