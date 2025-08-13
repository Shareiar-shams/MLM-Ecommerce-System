<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Order Management Routes
|--------------------------------------------------------------------------
|
| These routes handle order processing, transaction management,
| and order-related administrative functions.
|
*/

Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {
    Route::middleware(['admin', 'adminnotifications'])->group(function () {
        
        // ========================================
        // ORDER MANAGEMENT
        // ========================================
        Route::resource('/admin/orders', 'OrdersController');
        Route::put('/admin/orders/payment/status/{id}', 'OrdersController@payment_status')->name('orders.payment_status');
        Route::post('/admin/orders/payment/orderStatus/{id}', 'OrdersController@orderStatus')->name('orders.orderStatus');
        Route::get('/admin/orders/type/{type}', 'OrdersController@order_type')->name('orders.type');
        Route::get('/admin/orders/customize/orders', 'OrdersController@customize_orders')->name('orders.type.customize_orders');
        Route::get('/admin/charts/data', 'OrdersController@getChartData')->name('orders.chart.data');
        Route::get('/admin/order/status/{id}/order_status/{type}', 'OrdersController@type_status')->name('orders.type_status');
        Route::get('/admin/order/invoice/print/{id}', 'OrdersController@print_invoice')->name('orders.print_invoice');
        
        // ========================================
        // TRANSACTION MANAGEMENT
        // ========================================
        Route::resource('/admin/transections', 'TransectionsController');
        
        // ========================================
        // COUPON MANAGEMENT
        // ========================================
        Route::resource('/admin/coupon/code', 'CouponController');
        Route::put('/admin/coupon/status/{id}', 'CouponController@status')->name('code.status');
        
        // ========================================
        // SHIPPING MANAGEMENT
        // ========================================
        Route::resource('/admin/shipping', 'ShippingController');
        Route::put('/admin/shipping/status/{id}', 'ShippingController@status')->name('shipping.status');
    });
});
