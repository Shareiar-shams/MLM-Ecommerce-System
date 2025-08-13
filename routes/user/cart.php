<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Shopping Cart & Wishlist Routes
|--------------------------------------------------------------------------
|
| These routes handle shopping cart functionality, wishlist management,
| and checkout processes for the e-commerce system.
|
*/

Route::group(['namespace' => 'App\Http\Controllers\User'], function () {
    
    // ========================================
    // SHOPPING CART MANAGEMENT
    // ========================================
    Route::resource('cart', 'CartController');
    Route::get('/checkCart/{id}', 'CartController@check')->name('check');
    Route::delete('clear/cart/Product', 'CartController@cartDestroy')->name('cartDestroy');
    Route::get('/get-cart-session-display', 'CartController@getCartSessionDisplay')->name('getCartSessionDisplay');
    
    // ========================================
    // WISHLIST MANAGEMENT
    // ========================================
    Route::post('item/wish', 'CartController@wish')->name('wishPost');
    Route::get('/wishlists', 'CartController@wishlist')->name('wishlist');
    Route::delete('/wishlist/item/{id}', 'CartController@wishlistProductDelete')->name('wishlistProductDelete');
    Route::delete('/wishlist/clear', 'CartController@clearWishList')->name('clearWishList');
    
    // ========================================
    // COUPON SYSTEM
    // ========================================
    Route::get('/check/coupon/item', 'CartController@coupon_applied')->name('coupon_applied');
    
    // ========================================
    // CHECKOUT PROCESS
    // ========================================
    Route::get('/checkout', 'CartController@checkout')->name('checkout');
    Route::post('/update/billing/form-data', 'CartController@billing_data_update')->name('billing.form-data');
    Route::post('/update/shipping/form-data', 'CartController@shipping_data_update')->name('shipping.form-data');
    Route::post('/update/methodshipping/method/option', 'CartController@shipping_method_option')->name('shipping.method.option');
    Route::get('/session/data/fetch', 'CartController@session_data')->name('checkout.session_data');
    
    // ========================================
    // TESTING ROUTES (DEVELOPMENT ONLY)
    // ========================================
    Route::get('/test/shipping/method/option', 'CartController@test');
});
