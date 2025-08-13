<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Product Management Routes
|--------------------------------------------------------------------------
|
| These routes handle product management, categories, attributes,
| reviews, and product-related administrative functions.
|
*/

Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {
    Route::middleware(['admin', 'adminnotifications'])->group(function () {
        
        // ========================================
        // PRODUCT CATEGORIES
        // ========================================
        Route::resource('admin/product/categories', 'ProductCategoryController');
        Route::post('admin/product/subcategory', 'ProductCategoryController@subCat')->name('subcat');
        
        // ========================================
        // PRODUCT TYPES
        // ========================================
        Route::resource('admin/product/item/type', 'ProductTypeController');
        Route::put('admin/product/item/status/{id}', 'ProductTypeController@status')->name('type.status');
        
        // ========================================
        // PRODUCT MANAGEMENT
        // ========================================
        Route::resource('admin/product/item', 'ProductController');
        Route::get('admin/product/add', 'ProductController@add')->name('item.add');
        Route::get('admin/product/item/create', 'ProductController@create')->name('physical.product.create');
        Route::get('admin/product/item/affiliate/create', 'ProductController@affiliatecreate')->name('affiliate.product.create');
        Route::get('admin/product/item/customize/create', 'ProductController@customizecreate')->name('customize.product.create');
        Route::put('admin/product/status/{id}', 'ProductController@change_status')->name('item.status');
        Route::post('img_dlt', 'ProductController@img_dlt')->name('img_dlt');
        Route::get('admin/stock/out/product', 'ProductController@stockout')->name('product.stock.out');
        
        // ========================================
        // PRODUCT CAMPAIGNS & OFFERS
        // ========================================
        Route::get('admin/product/campaign', 'ProductController@campaign_offer')->name('product.campaign.offer');
        Route::put('admin/product/add/campaign/{id}', 'ProductController@product_campaing')->name('product.add.campaign.offer');
        Route::put('admin/product/campaign/status/{id}', 'ProductController@status')->name('product.campaign.status');
        Route::delete('admin/product/campaign/delete/{id}', 'ProductController@delete')->name('product.campaign.delete');
        
        // ========================================
        // PRODUCT REVIEWS
        // ========================================
        Route::resource('admin/product/review', 'ProductReviewController');
        
        // ========================================
        // PRODUCT ATTRIBUTES
        // ========================================
        Route::get('admin/product/{id}/attribute', 'ProductAttributeController@index')->name('product.attribute');
        Route::get('admin/product/{id}/attribute/options', 'ProductAttributeController@optionlist')->name('product.attribute.option');
        Route::get('admin/product/{id}/attribute/create', 'ProductAttributeController@create')->name('product.attribute.create');
        Route::get('admin/product/{id}/attribute/create/option', 'ProductAttributeController@optioncreate')->name('product.attribute.option.create');
        Route::get('admin/product/{productId}/attribute/{id}/edit', 'ProductAttributeController@edit')->name('product.attribute.edit');
        Route::get('admin/product/{productId}/attribute/{id}/edit/option', 'ProductAttributeController@editoption')->name('product.attribute.option.edit');
        Route::get('admin/product/{productId}/attribute/{id}/connect/option', 'ProductAttributeController@connect')->name('product.attribute.option.connect');
        Route::post('admin/product/{id}/attribute/store', 'ProductAttributeController@store')->name('product.attribute.store');
        Route::post('admin/product/{id}/attribute/option/store', 'ProductAttributeController@optionstore')->name('product.attribute.option.store');
        Route::post('admin/product/{productId}/attribute/{id}/update', 'ProductAttributeController@update')->name('product.attribute.update');
        Route::post('admin/product/{productId}/attribute/{id}/option/update', 'ProductAttributeController@optionupdate')->name('product.attribute.option.update');
        Route::resource('admin/product/attribute', 'ProductAttributeController');
        Route::delete('admin/product/option{id}', 'ProductAttributeController@optiondestroy')->name('product.attribute.option.destroy');
        
        // ========================================
        // PRODUCT CUSTOMIZATION
        // ========================================
        Route::get('admin/product/{id}/customize/design', 'ProductAttributeController@design_list')->name('product.customize.design');
        Route::get('admin/product/{id}/customize/create', 'ProductAttributeController@designcreate')->name('product.customize.design.create');
        Route::post('admin/product/{id}/customize/store', 'ProductAttributeController@designstore')->name('product.customize.design.store');
        Route::get('admin/product/{productId}/customize/{id}/edit', 'ProductAttributeController@designedit')->name('product.customize.design.edit');
        Route::put('admin/product/{productId}/customize/{id}/update', 'ProductAttributeController@designupdate')->name('product.customize.design.update');
        Route::delete('admin/product/customize/{id}/delete', 'ProductAttributeController@designdestroy')->name('product.customize.design.destroy');
        
        // ========================================
        // PRODUCT IMPORT/EXPORT
        // ========================================
        Route::get('/admin/product/export', 'ProductController@export')->name('product.export');
        Route::post('/admin/product/import', 'ProductController@import')->name('product.import');
        Route::get('/admin/bulk/product/index', 'ProductController@imexport')->name('product.import.export');
        
        // ========================================
        // DIGITAL PRODUCTS
        // ========================================
        Route::resource('/admin/digitalproduct', 'DigitalProductController');
        Route::put('/admin/digitalproduct/status/{id}', 'DigitalProductController@status')->name('digital.product.status');
        
        // ========================================
        // PRODUCT OFFERS
        // ========================================
        Route::resource('/admin/product/productoffer', 'OfferController');
        Route::put('/admin/product/productoffer/status/{id}', 'OfferController@status')->name('offer.status');
        Route::put('/admin/product/productoffer/description/{id}', 'OfferController@description')->name('productoffer.add.description');
        Route::get('/admin/productoffer/add/product/{id}', 'OfferController@digitalProduct')->name('productoffer.digitalproduct');
        Route::put('/admin/productoffer/add/addproduct/{id}', 'OfferController@adddigitalProduct')->name('productoffer.add.digitalproduct');
        Route::get('/admin/productoffer/add/user/{id}', 'OfferController@user')->name('productoffer.user');
        Route::put('/admin/productoffer/add/adduser/{id}', 'OfferController@associateUsersWithOffer')->name('productoffer.add.user');
    });
});
