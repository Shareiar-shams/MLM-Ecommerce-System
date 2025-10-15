<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->name('product.')->controller(ProductController::class)->group( function () {
    // ========================================
    // PRODUCT
    // ========================================

    Route::get('/index', 'index')->name('item.index');
    Route::get('/create', 'create')->name('item.create');
    Route::post('/store', 'store')->name('item.store');
    Route::post('/{id}/show', 'show')->name('item.show');
    Route::get('/edit/{id}', 'edit')->name('item.edit');
    Route::put('/update/{id}', 'update')->name('item.update');
    Route::delete('/destroy/{id}', 'destroy')->name('item.destroy');
    Route::put('/status/{id}', 'status')->name('item.status');
});