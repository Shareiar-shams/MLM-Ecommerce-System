<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// ========================================
// ADMIN ROUTES
// ========================================

Route::prefix('admin')->name('admin.')->group( function () {
    require __DIR__.'/Admin/auth.php';
    
    // ========================================
    // AUTHENTICATED ADMIN ROUTES
    // ========================================
    Route::middleware(['admin', 'localization'])->group(function () {
        // dashboard
        require __DIR__.'/Admin/dashboard.php';
        // categories
        require __DIR__.'/Admin/categories.php';
        // categories
        require __DIR__.'/Admin/type.php';
        // products
        require __DIR__.'/Admin/products.php';
        // theme settings
        require __DIR__.'/Admin/theme.php';
        // localization
        require __DIR__.'/Admin/localization.php';
    });
});