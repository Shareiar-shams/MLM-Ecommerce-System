<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| E-commerce Payment Routes
|--------------------------------------------------------------------------
|
| These routes handle payment processing for e-commerce orders
| including bKash, Stripe, PayPal, and Cash on Delivery.
|
*/

Route::group(['namespace' => 'App\Http\Controllers\User\Payment'], function () {
    
    // ========================================
    // BKASH PAYMENT GATEWAY
    // ========================================
    Route::resource('checkout/integrate/bkashPayment', 'BkashTokenizePaymentController');
    Route::get('/payment/bkash-callback', 'BkashTokenizePaymentController@callback')
        ->middleware(['verified'])
        ->name('bkashPayment.callBack');
    
    // ========================================
    // STRIPE PAYMENT GATEWAY
    // ========================================
    Route::resource('checkout/integrate/stripePayment', 'StripePaymentController');
    
    // ========================================
    // PAYPAL PAYMENT GATEWAY
    // ========================================
    Route::resource('checkout/integrate/paypalPayment', 'PaypalPaymentController');
    Route::get('/checkout/integrate/paypalPayment/success/transaction', 'PaypalPaymentController@successTransaction')
        ->middleware(['verified'])
        ->name('CheckoutsuccessPaypalTransaction');
    Route::get('/checkout/integrate/paypalPayment/cancel/transaction', 'PaypalPaymentController@cancelTransaction')
        ->middleware(['verified'])
        ->name('CheckoutcancelPaypalTransaction');
    
    // ========================================
    // CASH ON DELIVERY
    // ========================================
    Route::resource('checkout/integrate/codPayment', 'CODPaymentController');
});

// ========================================
// SSL COMMERZ PAYMENT GATEWAY
// ========================================
Route::group(['middleware' => [config('sslcommerz.middleware', 'sslcommerz')]], function () {
    Route::get('/sslcommerz/example1', [App\Http\Controllers\SslCommerzPaymentController::class, 'exampleEasyCheckout']);
    Route::get('/sslcommerz/example2', [App\Http\Controllers\SslCommerzPaymentController::class, 'exampleHostedCheckout']);
    
    Route::post('/sslcommerz/pay', [App\Http\Controllers\SslCommerzPaymentController::class, 'index']);
    Route::post('/sslcommerz/pay-via-ajax', [App\Http\Controllers\SslCommerzPaymentController::class, 'payViaAjax']);
    
    Route::post('/sslcommerz/success', [App\Http\Controllers\SslCommerzPaymentController::class, 'success']);
    Route::post('/sslcommerz/fail', [App\Http\Controllers\SslCommerzPaymentController::class, 'fail']);
    Route::post('/sslcommerz/cancel', [App\Http\Controllers\SslCommerzPaymentController::class, 'cancel']);
    
    Route::post('/sslcommerz/ipn', [App\Http\Controllers\SslCommerzPaymentController::class, 'ipn']);
});
