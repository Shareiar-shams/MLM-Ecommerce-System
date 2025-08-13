<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin User Management Routes
|--------------------------------------------------------------------------
|
| These routes handle user management, customer administration,
| MLM user management, and communication systems.
|
*/

Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {
    Route::middleware(['admin', 'adminnotifications'])->group(function () {
        
        // ========================================
        // CUSTOMER MANAGEMENT
        // ========================================
        Route::get('/admin/customers/list/', 'HomeController@create')->name('customers.list');
        Route::put('/admin/user/profile/status/{id}', 'HomeController@status')->name('user.profile.status');
        Route::get('/admin/user/profile/show/{id}', 'HomeController@show')->name('user.profile.show');
        Route::get('/admin/user/mlmuser/{id}', 'HomeController@check')->name('user.mlmuser.check');
        
        // ========================================
        // MLM USER MANAGEMENT
        // ========================================
        Route::resource('/admin/mlm/adminmlm', 'MLMController');
        Route::get('/admin/mlm/adminmlm/chat/{id}', 'MLMController@chat')->name('adminmlm.chat');
        Route::get('/admin/mlm/adminmlm/active/users', 'MLMController@active')->name('adminmlm.active');
        Route::get('/admin/mlm/adminmlm/inactive/parentinactive/users', 'MLMController@inactivebyadmin')->name('adminmlm.inactivebyadmin');
        Route::get('/admin/mlm/adminmlm/inactive/admininactive/users', 'MLMController@inactivebyparent')->name('adminmlm.inactivebyparent');
        Route::get('/admin/pay/to/user/{id}', 'MLMController@payuser')->name('pay.user');
        
        // ========================================
        // USER COMMUNICATION SYSTEM
        // ========================================
        Route::resource('/admin/mlm/user/userchat', 'MessageController');
        
        // ========================================
        // EMAIL MANAGEMENT
        // ========================================
        Route::get('/admin/user/email', 'HomeController@all_mail')->name('user.mail.list');
        Route::get('/admin/user/sent/email', 'HomeController@all_admin_sent_mail')->name('user.mail.sent.list');
        Route::get('/admin/user/email/show/{id}', 'HomeController@mail_show')->name('user.mail.show');
        Route::get('/admin/user/email/compose', 'HomeController@compose')->name('user.mail.compose');
        Route::post('/admin/user/email/send', 'HomeController@send')->name('user.mail.send');
        Route::delete('/admin/email/delete/{id}', 'HomeController@mail_destroy')->name('email.delete');
        Route::post('/admin/email/delete/{slug}/all', 'HomeController@deleteAll')->name('email.alldelete');
        
        // ========================================
        // SUBSCRIBER MANAGEMENT
        // ========================================
        Route::get('/admin/subscribers', 'HomeController@subscribers')->name('subscribers.list');
        Route::get('/admin/subscriber/send-email', 'HomeController@subscriber_mail')->name('subscriber_send_email');
        Route::post('/admin/subscriber/send-email-submit', 'HomeController@subscribers_mail_send')->name('subscriber_send_email_submit');
        Route::delete('/admin/subscribers/delete/{id}', 'HomeController@subscribers_delete')->name('subscribers.delete');
        
        // ========================================
        // ROLES & PERMISSIONS
        // ========================================
        Route::resource('roles', 'RoleController');
        Route::resource('admins', 'AdminController');
        Route::resource('permissions', 'PermissionController');
    });
});
