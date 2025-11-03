<?php

use App\Http\Controllers\Admin\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->name('product.')->controller(ProductController::class)->group( function () {
    // ========================================
    // PRODUCT
    // ========================================

    Route::get('/index', 'index')->name('item.index');
    Route::get('/create', 'create')->name('item.create');
    Route::post('/store', 'store')->name('item.store');
    Route::post('/{product}/show', 'show')->name('item.show');
    Route::get('/{product}/edit/', 'edit')->name('item.edit');
    Route::put('/update/{product}', 'update')->name('item.update');
    Route::delete('/destroy/{id}', 'destroy')->name('item.destroy');
    Route::put('/status/{id}', 'status')->name('item.status');
});