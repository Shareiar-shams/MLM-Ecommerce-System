<?php

use App\Http\Controllers\Admin\ProductTypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->name('product.')->controller(ProductTypeController::class)->group( function () {
    // ========================================
    // PRODUCT type
    // ========================================

    Route::get('type/index', 'index')->name('type.index');
    Route::get('type/create', 'create')->name('type.create');
    Route::post('type/store', 'store')->name('type.store');
    Route::get('type/edit/{id}', 'edit')->name('type.edit');
    Route::put('type/update/{id}', 'update')->name('type.update');
    Route::delete('type/destroy/{id}', 'destroy')->name('type.destroy');
    Route::put('type/status/{id}', 'status')->name('type.status');
});