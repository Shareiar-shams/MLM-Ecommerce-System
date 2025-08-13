<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Settings & Configuration Routes
|--------------------------------------------------------------------------
|
| These routes handle system settings, site configuration,
| and administrative customization options.
|
*/

Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {
    Route::middleware(['admin', 'adminnotifications'])->group(function () {
        
        // ========================================
        // GENERAL SYSTEM SETTINGS
        // ========================================
        Route::resource('/admin/setting/system', 'GeneralSettingController');
        
        // ========================================
        // HOME PAGE CONFIGURATION
        // ========================================
        Route::get('/admin/home-page', 'GeneralSettingController@homePage')->name('home-page.index');
        Route::put('/admin/home-page/single_type_carousal', 'GeneralSettingController@single_carousal')->name('single_carousal');
        Route::put('/admin/home-page/single_column', 'GeneralSettingController@single_column')->name('single_column');
        Route::put('/admin/home-page/double_column', 'GeneralSettingController@double_column')->name('double_column');
        Route::put('/admin/home-page/slider_products', 'GeneralSettingController@slider_products')->name('slider_products');
        Route::post('selected-categories', 'GeneralSettingController@selected_categoris_store')->name('selected-categories.store');
        
        // ========================================
        // SITE CUSTOMIZATION
        // ========================================
        Route::put('/admin/setting/name_customization', 'GeneralSettingController@app_name_customization')->name('app_name_customization');
        Route::put('/admin/setting/logo_customization', 'GeneralSettingController@app_logo_customization')->name('app_logo_customization');
        Route::put('/admin/setting/favicon_customization', 'GeneralSettingController@app_favicon_customization')->name('app_favicon_customization');
        Route::put('/admin/setting/loader_customization', 'GeneralSettingController@app_loader_customization')->name('app_loader_customization');
        Route::put('/admin/setting/meta_customization', 'GeneralSettingController@app_meta_customization')->name('app_meta_customization');
        
        // ========================================
        // MENU MANAGEMENT
        // ========================================
        Route::put('/admin/menu/status/{id}', 'GeneralSettingController@menu_status')->name('menu.status');
        Route::get('/admin/menu/edit/{id}', 'GeneralSettingController@menu_edit')->name('menu.edit');
        Route::put('/admin/menu/update/{id}', 'GeneralSettingController@menu_update')->name('menu.update');
        
        // ========================================
        // COOKIE CONFIGURATION
        // ========================================
        Route::get('/admin/cookie/alert', 'GeneralSettingController@cookie_show')->name('cookie.show');
        Route::put('/admin/cookie/configaration', 'GeneralSettingController@cookie_update')->name('cookie_configaration_put');
        
        // ========================================
        // SOCIAL MEDIA SETTINGS
        // ========================================
        Route::resource('/admin/setting/social', 'SocialMediaController');
        Route::put('/admin/setting/media/update', 'SocialMediaController@store')->name('media_data_update');
        
        // ========================================
        // EMAIL CONFIGURATION
        // ========================================
        Route::get('/admin/setting/email', 'SocialMediaController@email')->name('email_configuration');
        Route::put('/admin/setting/email/configaration', 'SocialMediaController@email_configuration')->name('email_configaration_put');
        
        // ========================================
        // ANNOUNCEMENT SETTINGS
        // ========================================
        Route::get('/admin/setting/announcement', 'SocialMediaController@create')->name('announcement');
        Route::put('/admin/setting/announcement/update', 'SocialMediaController@announcementupdate')->name('announcementupdate');
        
        // ========================================
        // SOCIAL ICONS
        // ========================================
        Route::resource('/admin/setting/icon', 'SocialIconController');
        Route::put('/admin/icon/status/{id}', 'SocialIconController@status')->name('icon.status');
        
        // ========================================
        // PAYMENT GATEWAY SETTINGS
        // ========================================
        Route::resource('/admin/setting/payment', 'PaymentController');
        
        // ========================================
        // SLIDER MANAGEMENT
        // ========================================
        Route::resource('/admin/slider', 'SliderController');
        Route::put('/admin/slider/status/{id}', 'SliderController@status')->name('slider.status');
    });
});
