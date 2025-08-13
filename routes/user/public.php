<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public User Routes
|--------------------------------------------------------------------------
|
| These routes are accessible to all users without authentication
| and handle the main e-commerce functionality like browsing products,
| viewing pages, and basic interactions.
|
*/

Route::group(['namespace' => 'App\Http\Controllers\User'], function () {
    
    // ========================================
    // HOME & MAIN PAGES
    // ========================================
    Route::get('/', 'ViewportController@index')
        ->middleware(['cookie-consent'])
        ->name('main');
    
    Route::get('/about', 'ViewportController@about')->name('about');
    Route::get('/contact', 'ViewportController@contact')->name('contact');
    Route::post('/contact-mail', 'ViewportController@contact_email')->name('contact_email');
    Route::get('/affiliate', 'ViewportController@affiliate')->name('affiliate');
    
    // ========================================
    // PRODUCT BROWSING
    // ========================================
    Route::get('/products', 'ViewportController@products')->name('products');
    Route::get('/products/{productType}', 'ViewportController@getProductsByType')->name('fetch_product');
    Route::get('/product/{slug}', 'ViewportController@productDetails')->name('productDetails');
    Route::get('/products/referrer/{referrer}', 'ViewportController@user_shop')->name('user.shop');
    Route::get('/products/{slug}/referrer/{referrer}', 'ViewportController@referrer_product')->name('product.referrer');
    Route::get('/top/products', 'ViewportController@top_product')->name('product.top_product');
    
    // ========================================
    // PRODUCT FILTERING & SEARCH
    // ========================================
    Route::get('products/categories/{category}', 'ViewportController@shopcategories')->name('shopcategory');
    Route::get('pagination/products/categories/{category}', 'ViewportController@pagination_category')->name('pagination_category');
    Route::get('pagination/products', 'ViewportController@pagination_product')->name('pagination_product');
    Route::get('price/range/products', 'ViewportController@price_range')->name('price_range');
    Route::get('price/range/products/{category}', 'ViewportController@price_range_category')->name('price_range_category');
    Route::get('/products/type/{slug}', 'ViewportController@product_show_type')->name('product_show_type');
    Route::get('search/products/{category}', 'ViewportController@product_search')->name('product_search');
    Route::get('/search/products', 'ViewportController@search')->name('search.products');
    Route::get('products/tag/{tag}', 'ViewportController@filterByTag')->name('products.byTag');
    
    // ========================================
    // DYNAMIC CONTENT
    // ========================================
    Route::get('/page/{slug}', 'ViewportController@page')->name('DynamicPageView');
    Route::get('campaign/products', 'ViewportController@campaign_product')->name('campaign_product');
    
    // ========================================
    // PRODUCT CUSTOMIZATION
    // ========================================
    Route::get('/customize-your-product/{slug}', 'ViewportController@customize_product')->name('user.customize.product');
    
    // ========================================
    // FAQ SYSTEM
    // ========================================
    Route::get('/faq', 'ViewportController@faq')->name('faq');
    Route::get('/faq/catalog/{category}', 'ViewportController@faq_catalog')->name('faq_catalog');
    
    // ========================================
    // ORDER TRACKING (PUBLIC)
    // ========================================
    Route::get('/track/order', 'ViewportController@orderTrack')->name('orderTrack');
    Route::get('/track/request', 'ViewportController@track_request')->name('track_request');
    Route::get('/invoice', 'ViewportController@invoice')->name('invoice');
    
    // ========================================
    // REVIEWS
    // ========================================
    Route::get('review/store/{product}', 'ViewportController@reviewstore')->name('review.reviewstore');
    
    // ========================================
    // NEWSLETTER SUBSCRIPTION
    // ========================================
    Route::post('user/subscriber', 'ViewportController@store')->name('user_subscribe');
    
    // ========================================
    // RECENT PRODUCTS DISPLAY
    // ========================================
    Route::get('/get-recent-product-display/{slug}', 'ViewportController@getRecentProductDisplay')->name('getRecentProductDisplay');
    Route::get('/get-all-recent-product-display/', 'ViewportController@getAllRecentProductDisplay')->name('getAllRecentProductDisplay');
});
