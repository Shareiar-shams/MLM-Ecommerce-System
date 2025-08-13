<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Authentication Routes
|--------------------------------------------------------------------------
|
| These routes handle user authentication including social login,
| profile management, and authenticated user features.
|
*/

Route::group(['namespace' => 'App\Http\Controllers\User'], function () {
    
    // ========================================
    // SOCIAL AUTHENTICATION (PUBLIC)
    // ========================================
    
    // Facebook OAuth
    Route::get('/redirect', 'SocialAuthFacebookController@redirect')->name('redirect');
    Route::get('/callback', 'SocialAuthFacebookController@callback');
    
    // Google OAuth
    Route::get('auth/google', 'GoogleController@redirectToGoogle')->name('google.redirect');
    Route::get('auth/google/callback', 'GoogleController@handleGoogleCallback');
    
    // ========================================
    // AUTHENTICATED USER ROUTES
    // ========================================
    Route::middleware(['auth', 'usermessagenotifications'])->group(function () {
        
        // User Dashboard
        Route::get('/dashboard', 'App\Http\Controllers\HomeController@index')
            ->middleware(['verified'])
            ->name('dashboard');
        
        // User Profile Management
        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/image/update', [App\Http\Controllers\ProfileController::class, 'imgupdate'])->name('image.update');
        Route::post('/banking/credential', [App\Http\Controllers\ProfileController::class, 'credential'])->name('bank.credential');
        
        // User Orders
        Route::get('/user/order/products', 'App\Http\Controllers\HomeController@order')
            ->middleware(['verified'])
            ->name('orders');
        Route::get('user/order/invoice/{id}', 'App\Http\Controllers\HomeController@order_details')
            ->middleware(['verified'])
            ->name('order_details');
        
        // User Communication
        Route::get('/chats', 'App\Http\Controllers\HomeController@chats')
            ->middleware(['verified'])
            ->name('all.chats');
        Route::post('/chats/store', 'App\Http\Controllers\HomeController@chatstore')
            ->middleware(['verified'])
            ->name('chats.store');
        
        Route::get('/notifications', 'App\Http\Controllers\HomeController@notifications')
            ->middleware(['verified'])
            ->name('all.notifications');
        
        // Support Ticket System
        Route::get('/ticket', 'App\Http\Controllers\HomeController@ticket')->name('ticket');
        Route::get('/ticketCreate', 'App\Http\Controllers\HomeController@ticketCreate')->name('ticketCreate');
        Route::post('/ticket/generate', 'App\Http\Controllers\HomeController@store')->name('generate.ticket');
        Route::get('/generate/ticket/show/{uuid}', 'App\Http\Controllers\HomeController@ticketshow')->name('tickets.show');
    });
    
    // ========================================
    // VERIFIED USER ONLY ROUTES
    // ========================================
    Route::middleware(['auth', 'verified'])->group(function () {
        
        // MLM User Payment Processing
        Route::get('/payforuser/{id}', 'App\Http\Controllers\HomeController@show')->name('payforuser');
        
        // Additional verified user routes can be added here
        
    });
});
