<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
|
| These routes handle admin authentication, session management,
| and basic admin profile functionality.
|
*/

Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {
    
    // ========================================
    // ADMIN AUTHENTICATION (PUBLIC)
    // ========================================
    Route::get('/admin/login', 'Auth\AdminAuthenticatedSessionController@create')->name('admin.login');
    Route::post('/admin/login', 'Auth\AdminAuthenticatedSessionController@authenticate')->name('admin.login.post');
    Route::post('/admin/logout', 'Auth\AdminAuthenticatedSessionController@destroy')->name('admin.logout');
    
    // ========================================
    // ADMIN SESSION MANAGEMENT
    // ========================================
    Route::get('/admin/check-auth', 'Auth\AdminAuthenticatedSessionController@checkAuth')->name('admin.check.auth');
    Route::post('/admin/refresh-session', 'Auth\AdminAuthenticatedSessionController@refreshSession')->name('admin.refresh.session');
    
    // ========================================
    // AUTHENTICATED ADMIN ROUTES
    // ========================================
    Route::middleware(['admin', 'adminnotifications'])->group(function () {
        
        // Admin Dashboard
        Route::get('/admin/home', 'HomeController@index')->name('admin.home');
        Route::get('/admin/profile', 'HomeController@profile')->name('admin.profile');
        
        // Admin Profile Management
        Route::post('/admin/image/update/{id}', 'HomeController@imgupdate')->name('admin.image.update');
        Route::put('/admin/password/update/{id}', 'HomeController@passupdate')->name('admin.password.update');
        Route::put('/admin/profile/update/{id}', 'HomeController@update')->name('admin.profile.update');
        
        // Cache Management
        Route::get('/admin/cache/clear', 'HomeController@cache')->name('cache.clear');
        
        // Main Controller Resource
        Route::resource('/admin/homecontroller', 'HomeController');
    });
});
