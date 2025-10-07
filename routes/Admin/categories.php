<?php

use App\Http\Controllers\Admin\ProductCategoriesController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->name('product.')->controller(ProductCategoriesController::class)->group( function () {
    // ========================================
    // PRODUCT CATEGORIES
    // ========================================

    Route::get('categoies', 'index')->name('categories');
    Route::post('subcategories', 'subcategories')->name('subcategories');
    Route::put('categories/status/{id}', 'status')->name('categories.status');
});
// Main Controller Resource
Route::resource('product/categories', ProductCategoriesController::class);