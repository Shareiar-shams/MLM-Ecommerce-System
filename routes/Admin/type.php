<?php

use App\Http\Controllers\Admin\ProductCategoriesController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->name('product.')->controller(ProductCategoriesController::class)->group( function () {
    // ========================================
    // PRODUCT type
    // ========================================

    Route::get('index', 'index')->name('type.index');
    Route::get('create', 'create')->name('type.create');
    Route::post('store', 'store')->name('type.store');
    Route::get('edit/{id}', 'edit')->name('type.edit');
    Route::put('update/{id}', 'update')->name('type.update');
    Route::delete('destroy/{id}', 'destroy')->name('type.destroy');
    Route::put('type/status/{id}', 'status')->name('type.status');
});