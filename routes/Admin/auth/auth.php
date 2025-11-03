<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminAuthenticatedSessionController;

Route::controller(AdminAuthenticatedSessionController::class)->group( function () {
    // ========================================
    // ADMIN AUTHENTICATION (PUBLIC)
    // ========================================
    Route::get('login', 'create')->name('login');
    Route::post('login', 'authenticate')->name('login.post');
    Route::post('logout', 'destroy')->name('logout');

    // ========================================
    // ADMIN SESSION MANAGEMENT
    // ========================================
    Route::get('check-auth', 'checkAuth')->name('check.auth');
    Route::post('refresh-session', 'refreshSession')->name('refresh.session');
});