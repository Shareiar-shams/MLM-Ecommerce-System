<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Content Management Routes
|--------------------------------------------------------------------------
|
| These routes handle content management including pages, FAQs,
| tickets, and other content-related administrative functions.
|
*/

Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {
    Route::middleware(['admin', 'adminnotifications'])->group(function () {
        
        // ========================================
        // PAGE MANAGEMENT
        // ========================================
        Route::resource('admin/page', 'PageController');
        Route::put('/admin/page/status/{id}', 'PageController@status')->name('page.status');
        
        // ========================================
        // FAQ MANAGEMENT
        // ========================================
        Route::resource('admin/faqcategory', 'FaqCategoryController');
        Route::put('/admin/faqcategory/status/{id}', 'FaqCategoryController@status')->name('faqcategory.status');
        Route::resource('admin/faq', 'FaqController');
        
        // ========================================
        // SUPPORT TICKET SYSTEM
        // ========================================
        Route::resource('/admin/ticket', 'TicketController');
        Route::put('/admin/ticket/close/{uuid}', 'TicketController@close')->name('ticket.close');
        Route::post('admin/ticket/store', 'TicketController@ticketStore')->name('ticketStore');
        
        // Ticket Categories
        Route::resource('/admin/tickets/ticket-categories', 'TicketCategoryController');
        Route::put('/admin/tickets/category/status/{id}', 'TicketCategoryController@status')->name('ticket-categories.status');
        
        // Ticket Labels
        Route::resource('/admin/tickets/ticket-labels', 'TicketLabelController');
        Route::put('/admin/tickets/labels/status/{id}', 'TicketLabelController@status')->name('ticket-labels.status');
        
        // ========================================
        // CONTACT MANAGEMENT
        // ========================================
        Route::resource('/admin/contact/dyContact', 'ContactController');
    });
});
