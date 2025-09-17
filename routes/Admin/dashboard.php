<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group( function () {
    // ========================================
    // ADMIN DASHBOARD
    // ========================================
    Route::get('dashboard', 'index')->name('home');
    Route::get('profile', 'create')->name('profile');

    // Admin Profile Management
    Route::put('image/update/{id}', 'imgupdate')->name('image.update');
    Route::put('password/update/{id}', 'passupdate')->name('password.update');
    Route::put('profile/update/{id}', 'update')->name('profile.update');
    
    // admin Activity Log
    Route::get('activities', 'activities')->name('activities.index');
    
    // Cache Management
    Route::get('cache/clear', 'cache')->name('cache.clear');
});
// Main Controller Resource
Route::resource('homecontroller', HomeController::class);