<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| MLM Payment Routes
|--------------------------------------------------------------------------
|
| These routes handle payment processing for MLM products and services
| including user activation payments and MLM-specific transactions.
|
*/

Route::middleware(['auth', 'verified'])->group(function () {
    
    // ========================================
    // MLM USER BKASH PAYMENTS
    // ========================================
    Route::get('/mlmuser/bkash/payment', [App\Http\Controllers\User\MlmUserBkashTokenizePaymentController::class, 'mlmuser.bkash.index']);
    Route::post('/mlmuser/bkash/create/payment', [App\Http\Controllers\User\MlmUserBkashTokenizePaymentController::class, 'createPayment'])
        ->name('mlmuser.bkash.create.payment');
    Route::get('/mlmuser/bkash/callback', [App\Http\Controllers\User\MlmUserBkashTokenizePaymentController::class, 'callBack'])
        ->name('mlmuser.bkash-callBack');
    
    // ========================================
    // NORMAL USER BKASH PAYMENTS (MLM ACTIVATION)
    // ========================================
    Route::get('/user/bkash/payment', [App\Http\Controllers\User\UserBkashTokenizePaymentController::class, 'user.bkash.index']);
    Route::post('/user/bkash/create/payment', [App\Http\Controllers\User\UserBkashTokenizePaymentController::class, 'createPayment'])
        ->name('user.bkash.create.payment');
    Route::get('/user/bkash/callback', [App\Http\Controllers\User\UserBkashTokenizePaymentController::class, 'callBack'])
        ->name('user.bkash-callBack');
    
    // ========================================
    // GENERAL BKASH PAYMENTS
    // ========================================
    Route::get('/bkash/payment', [App\Http\Controllers\BkashTokenizePaymentController::class, 'index']);
    Route::post('/bkash/create/payment', [App\Http\Controllers\BkashTokenizePaymentController::class, 'createPayment'])
        ->name('bkash.create.payment');
    Route::get('/bkash/callback', [App\Http\Controllers\BkashTokenizePaymentController::class, 'callBack'])
        ->name('bkash-callBack');
    
    // ========================================
    // MLM STRIPE PAYMENTS
    // ========================================
    Route::post('/mlmuser/stripe/create/payment', [App\Http\Controllers\User\MlmUserStripeTokenizePayment::class, 'createPayment'])
        ->name('mlmuser.stripe.create.payment');
    Route::get('/test/stripe/create/payment', [App\Http\Controllers\User\UserStripeTokenizePayment::class, 'testStripe'])
        ->name('test.stripe.route');
    Route::post('/user/stripe/create/payment', [App\Http\Controllers\User\UserStripeTokenizePayment::class, 'createPayment'])
        ->name('user.stripe.create.payment');
    Route::get('stripe/checkout/success', [App\Http\Controllers\User\UserStripeTokenizePayment::class, 'stripeCheckoutSuccess'])
        ->name('stripe.checkout.success');
    
    // ========================================
    // MLM PAYPAL PAYMENTS
    // ========================================
    Route::get('/mlmuser/paypal/create/transaction', [App\Http\Controllers\User\UserPaypalPayment::class, 'createTransaction'])
        ->name('createPaypalTransaction');
    Route::post('/mlmuser/paypal/create/payment', [App\Http\Controllers\User\UserPaypalPayment::class, 'processTransaction'])
        ->name('processPaypalTransaction');
    Route::get('/mlmuser/paypal/payment/success/transaction', [App\Http\Controllers\User\UserPaypalPayment::class, 'successTransaction'])
        ->name('successPaypalTransaction');
    Route::get('/mlmuser/paypal/payment/cancel/transaction', [App\Http\Controllers\User\UserPaypalPayment::class, 'cancelTransaction'])
        ->name('cancelPaypalTransaction');
});
