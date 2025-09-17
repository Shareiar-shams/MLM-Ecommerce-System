<?php

use App\Http\Controllers\Admin\ProductCategoriesController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->name('product.')->controller(ProductCategoriesController::class)->group( function () {
    // ========================================
    // PRODUCT CATEGORIES
    // ========================================

    Route::get('categoies', 'index')->name('categories');
    Route::post('subcategories', 'subcategories')->name('subcategories');
});
// Main Controller Resource
Route::resource('product/categories', ProductCategoriesController::class);