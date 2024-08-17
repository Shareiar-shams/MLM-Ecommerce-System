<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['namespace'=> 'App\Http\Controllers\User', ],function(){

    Route::get('/', 'ViewportController@index')->middleware(['cookie-consent'])->name('main');
    Route::get('/products/{productType}', 'ViewportController@getProductsByType')->name('fetch_product');
    Route::get('/about', 'ViewportController@about')->name('about');

    Route::get('/contact', 'ViewportController@contact')->name('contact');
    //Contact Mail
    Route::post('/contact-mail', 'ViewportController@contact_email')->name('contact_email');

    Route::get('/affiliate', 'ViewportController@affiliate')->name('affiliate');
    Route::get('mlmproduct/{id}', 'ViewportController@mlmProduct')->name('mlmproduct');
    Route::get('/digital/product/purchase', 'ViewportController@mlmcheckout')->name('mlmcheckout');

    Route::get('/products', 'ViewportController@products')->name('products');

    Route::get('/products/referrer/{referrer}', 'ViewportController@user_shop')->name('user.shop');

    // Route::post('search/product','ViewportController@product_search')->name('product_search');
    Route::get('products/categories/{category}', 'ViewportController@shopcategories')->name('shopcategory');
    
    Route::get('pagination/products/categories/{category}', 'ViewportController@pagination_category')->name('pagination_category');
    Route::get('pagination/products', 'ViewportController@pagination_product')->name('pagination_product');

    Route::get('price/range/products', 'ViewportController@price_range')->name('price_range');
    Route::get('price/range/products/{category}', 'ViewportController@price_range_category')->name('price_range_category');

    Route::get('/products/type/{slug}','ViewportController@product_show_type')->name('product_show_type');

    Route::get('search/products/{category}','ViewportController@product_search')->name('product_search');

    Route::get('/product/{slug}', 'ViewportController@productDetails')->name('productDetails');

    Route::get('/products/{slug}/referrer/{referrer}', 'ViewportController@referrer_product')->name('product.referrer');

    Route::get('/top/products', 'ViewportController@top_product')->name('product.top_product');

    Route::get('products/tag/{tag}', 'ViewportController@filterByTag')->name('products.byTag');

    //page route
    Route::get('/page/{slug}','ViewportController@page')->name('DynamicPageView');

    Route::get('review/store/{product}', 'ViewportController@reviewstore')->name('review.reviewstore');

    Route::get('campaign/products', 'ViewportController@campaign_product')->name('campaign_product');

    Route::get('/track/order', 'ViewportController@orderTrack')->name('orderTrack');   
    Route::get('/track/request', 'ViewportController@track_request')->name('track_request');   

    Route::get('/invoice', 'ViewportController@invoice')->name('invoice');

    Route::get('/search/products', 'ViewportController@search')->name('search.products');

    // Customize Product Route
    Route::get('/customize-your-product/{slug}', 'ViewportController@customize_product')->name('user.customize.product');

    // Faqs Route
    Route::get('/faq', 'ViewportController@faq')->name('faq');

    Route::get('/faq/catalog/{category}', 'ViewportController@faq_catalog')->name('faq_catalog');

    //linked route
    Route::get('/digitalproduct/{digitalproduct}/offer/{offer}/type/{type}/purchase/{user}', 'DigitalProductController@index')->name('offer.purchase');
    Route::get('/user/referrer/{referrer}/type/{type}', 'DigitalProductController@referrer_user')->name('user.referrer');

    Route::resource('cart','CartController');

    Route::get('/checkCart/{id}', 'CartController@check')->name('check');


    Route::delete('clear/cart/Product', 'CartController@cartDestroy')->name('cartDestroy');

    Route::post('item/wish', 'CartController@wish')->name('wishPost');
    Route::get('/wishlists', 'CartController@wishlist')->name('wishlist');
    Route::delete('/wishlist/item/{id}', 'CartController@wishlistProductDelete')->name('wishlistProductDelete');
    Route::delete('/wishlist/clear', 'CartController@clearWishList')->name('clearWishList');

    Route::get('/get-cart-session-display', 'CartController@getCartSessionDisplay')->name('getCartSessionDisplay');

    Route::get('/get-recent-product-display/{slug}', 'ViewportController@getRecentProductDisplay')->name('getRecentProductDisplay');
    Route::get('/get-all-recent-product-display/', 'ViewportController@getAllRecentProductDisplay')->name('getAllRecentProductDisplay');

    
    Route::get('/check/coupon/item', 'CartController@coupon_applied')->name('coupon_applied');

    Route::get('/checkout', 'CartController@checkout')->name('checkout');

    Route::post('/update/billing/form-data', 'CartController@billing_data_update')->name('billing.form-data');
    Route::post('/update/shipping/form-data', 'CartController@shipping_data_update')->name('shipping.form-data');
    Route::post('/update/methodshipping/method/option', 'CartController@shipping_method_option')->name('shipping.method.option');

    Route::get('/session/data/fetch', 'CartController@session_data')->name('checkout.session_data');

    Route::get('/test/shipping/method/option', 'CartController@test');

    Route::post('user/subscriber','ViewportController@store')->name('user_subscribe');
    //Social Login

    Route::get('/redirect', 'SocialAuthFacebookController@redirect')->name('redirect');
    Route::get('/callback', 'SocialAuthFacebookController@callback');

    Route::get('auth/google', 'GoogleController@redirectToGoogle')->name('google.redirect');
    Route::get('auth/google/callback', 'GoogleController@handleGoogleCallback');

});

/*
|--------------------------------------------------------------------------
| E-commerce Payment Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['namespace'=> 'App\Http\Controllers\User\Payment', ],function(){
    Route::resource('checkout/integrate/bkashPayment','BkashTokenizePaymentController');
    Route::get('/payment/bkash-callback', 'BkashTokenizePaymentController@callback')->middleware(['verified'])->name('bkashPayment.callBack');
    Route::resource('checkout/integrate/stripePayment','StripePaymentController');

    Route::resource('checkout/integrate/paypalPayment','PaypalPaymentController');

    Route::get('/checkout/integrate/paypalPayment/success/transaction', 'PaypalPaymentController@successTransaction')->middleware(['verified'])->name('CheckoutsuccessPaypalTransaction');

    Route::get('/checkout/integrate/paypalPayment/cancel/transaction', 'PaypalPaymentController@cancelTransaction')->middleware(['verified'])->name('CheckoutcancelPaypalTransaction');
    Route::resource('checkout/integrate/codPayment','CODPaymentController');
});
/*
|--------------------------------------------------------------------------
| SSLcommerz Route
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware'=>[config('sslcommerz.middleware','sslcommerz')]], function () {
    Route::get('/sslcommerz/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
    Route::get('/sslcommerz/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

    Route::post('/sslcommerz/pay', [SslCommerzPaymentController::class, 'index']);
    Route::post('/sslcommerz/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

    Route::post('/sslcommerz/success', [SslCommerzPaymentController::class, 'success']);
    Route::post('/sslcommerz/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/sslcommerz/cancel', [SslCommerzPaymentController::class, 'cancel']);

    Route::post('/sslcommerz/ipn', [SslCommerzPaymentController::class, 'ipn']);
});

/*
|--------------------------------------------------------------------------
| User Message Notification Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth','usermessagenotifications')->group(function () {
    Route::get('/dashboard', 'App\Http\Controllers\HomeController@index')->middleware(['verified'])->name('dashboard');
    Route::get('/payforuser/{id}', 'App\Http\Controllers\HomeController@show')->middleware(['verified'])->name('payforuser');
    Route::get('/sell/report', 'App\Http\Controllers\HomeController@sellReport')->middleware(['verified'])->name('sell.report');
    Route::get('/today/sell/report', 'App\Http\Controllers\HomeController@todaysellReport')->middleware(['verified'])->name('today.sell.report');
    Route::get('/weekly/sell/report', 'App\Http\Controllers\HomeController@weeklysellReport')->middleware(['verified'])->name('weekly.sell.report');
    Route::get('/total/active/child', 'App\Http\Controllers\HomeController@activechild')->middleware(['verified'])->name('total.active.child');
    Route::get('/total/sell', 'App\Http\Controllers\HomeController@totalSell')->middleware(['verified'])->name('total.sell');
    Route::get('/myproduct', 'App\Http\Controllers\HomeController@myproduct')->middleware(['verified'])->name('myproduct');
    Route::get('/course/details', 'App\Http\Controllers\HomeController@courseDetails')->middleware(['verified'])->name('course.details');
    Route::get('/tools', 'App\Http\Controllers\HomeController@tools')->middleware(['verified'])->name('tools');

    Route::get('/user/order/products', 'App\Http\Controllers\HomeController@order')->middleware(['verified'])->name('orders');
    Route::get('user/order/invoice/{id}', 'App\Http\Controllers\HomeController@order_details')->middleware(['verified'])->name('order_details');

    Route::get('/basic/links', 'App\Http\Controllers\HomeController@basiclink')->middleware(['verified'])->name('basic.links');
    Route::get('/normal/links', 'App\Http\Controllers\HomeController@normallink')->middleware(['verified'])->name('normal.links');
    Route::get('/special/links', 'App\Http\Controllers\HomeController@specialLink')->middleware(['verified'])->name('special.links');
    Route::get('/offer/details', 'App\Http\Controllers\HomeController@offerDetails')->middleware(['verified'])->name('offer.details.show');
    Route::get('/pending/user', 'App\Http\Controllers\HomeController@pendingUser')->middleware(['verified'])->name('user.pending');
    Route::get('/admin/pending/user', 'App\Http\Controllers\HomeController@adminPending')->middleware(['verified'])->name('admin.pending');
    Route::get('/sell/products', 'App\Http\Controllers\HomeController@product_sells')->middleware(['verified'])->name('product_sells');
    Route::post('/add/product/', 'App\Http\Controllers\HomeController@add_product')->middleware(['verified'])->name('add_product');
    Route::get('/ticket', 'App\Http\Controllers\HomeController@ticket')->name('ticket');
    Route::get('/ticketCreate', 'App\Http\Controllers\HomeController@ticketCreate')->name('ticketCreate');

    Route::post('/ticket/generate', 'App\Http\Controllers\HomeController@store')->name('generate.ticket');
    Route::get('/generate/ticket/show/{uuid}', 'App\Http\Controllers\HomeController@ticketshow')->name('tickets.show');

    //


    Route::get('/chats', 'App\Http\Controllers\HomeController@chats')->middleware(['verified'])->name('all.chats');
    Route::post('/chats/store', 'App\Http\Controllers\HomeController@chatstore')->middleware(['verified'])->name('chats.store');

    Route::get('/notifications', 'App\Http\Controllers\HomeController@notifications')->middleware(['verified'])->name('all.notifications');
    // Route::post('/token', 'App\Http\Controllers\HomeController@token')->middleware(['verified'])->name('token');
    // Route::get('/createpayment', 'App\Http\Controllers\HomeController@createpayment')->middleware(['verified'])->name('createpayment');
    // Route::get('/executepayment', 'App\Http\Controllers\HomeController@executepayment')->middleware(['verified'])->name('executepayment');

    //Mlm user pay admin for active child
    Route::get('/mlmuser/bkash/payment', [App\Http\Controllers\User\MlmUserBkashTokenizePaymentController::class,'mlmuser.bkash.index']);
    Route::post('/mlmuser/bkash/create/payment', [App\Http\Controllers\User\MlmUserBkashTokenizePaymentController::class,'createPayment'])->middleware(['verified'])->name('mlmuser.bkash.create.payment');
    Route::get('/mlmuser/bkash/callback', [App\Http\Controllers\User\MlmUserBkashTokenizePaymentController::class,'callBack'])->middleware(['verified'])->name('mlmuser.bkash-callBack');


    //Normal user pay admin for create mlm account
    Route::get('/user/bkash/payment', [App\Http\Controllers\User\UserBkashTokenizePaymentController::class,'user.bkash.index']);
    Route::post('/user/bkash/create/payment', [App\Http\Controllers\User\UserBkashTokenizePaymentController::class,'createPayment'])->middleware(['verified'])->name('user.bkash.create.payment');
    Route::get('/user/bkash/callback', [App\Http\Controllers\User\UserBkashTokenizePaymentController::class,'callBack'])->middleware(['verified'])->name('user.bkash-callBack');
    //Pay to reffer

    Route::post('/pay/referrer','App\Http\Controllers\User\ViewportController@payReferre')->middleware(['verified'])->name('pay.referrer');

    // Payment Routes for bKash
    Route::get('/bkash/payment', [App\Http\Controllers\BkashTokenizePaymentController::class,'index']);
    Route::post('/bkash/create/payment', [App\Http\Controllers\BkashTokenizePaymentController::class,'createPayment'])->middleware(['verified'])->name('bkash.create.payment');
    Route::get('/bkash/callback', [App\Http\Controllers\BkashTokenizePaymentController::class,'callBack'])->middleware(['verified'])->name('bkash-callBack');

    //Stripe payment route for mlm product
    Route::post('/mlmuser/stripe/create/payment', [App\Http\Controllers\User\MlmUserStripeTokenizePayment::class,'createPayment'])->middleware(['verified'])->name('mlmuser.stripe.create.payment');
    Route::get('/test/stripe/create/payment', [App\Http\Controllers\User\UserStripeTokenizePayment::class,'testStripe'])->name('test.stripe.route');
    Route::post('/user/stripe/create/payment', [App\Http\Controllers\User\UserStripeTokenizePayment::class,'createPayment'])->name('user.stripe.create.payment');
    Route::get('stripe/checkout/success', [App\Http\Controllers\User\UserStripeTokenizePayment::class, 'stripeCheckoutSuccess'])->name('stripe.checkout.success');

    //Paypal Payment route for mlm product
    Route::get('/mlmuser/paypal/create/transaction', [App\Http\Controllers\User\UserPaypalPayment::class, 'createTransaction'])->name('createPaypalTransaction');

    Route::post('/mlmuser/paypal/create/payment', [App\Http\Controllers\User\UserPaypalPayment::class, 'processTransaction'])->middleware(['verified'])->name('processPaypalTransaction');

    Route::get('/mlmuser/paypal/payment/success/transaction', [App\Http\Controllers\User\UserPaypalPayment::class, 'successTransaction'])->middleware(['verified'])->name('successPaypalTransaction');

    Route::get('/mlmuser/paypal/payment/cancel/transaction', [App\Http\Controllers\User\UserPaypalPayment::class, 'cancelTransaction'])->middleware(['verified'])->name('cancelPaypalTransaction');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/image/update', [ProfileController::class, 'imgupdate'])->name('image.update');
    Route::post('/banking/credential', [ProfileController::class, 'credential'])->name('bank.credential');

    
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth','verified')->group(function () {
    

    // //search payment
    // Route::get('/bkash/search/{trxID}', [App\Http\Controllers\BkashTokenizePaymentController::class,'searchTnx'])->name('bkash-serach');

    // //refund payment routes
    // Route::get('/bkash/refund', [App\Http\Controllers\BkashTokenizePaymentController::class,'refund'])->name('bkash-refund');
    // Route::get('/bkash/refund/status', [App\Http\Controllers\BkashTokenizePaymentController::class,'refundStatus'])->name('bkash-refund-status');
    
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::group(['namespace'=> 'App\Http\Controllers\Admin'],function(){

    Route::get('/admin/login', 'Auth\AuthenticatedSessionController@create')->name('admin.login');
    Route::post('/admin/login', 'Auth\AuthenticatedSessionController@authenticate')->name('admin.login.post');
    Route::post('/admin/logout', 'Auth\AuthenticatedSessionController@destroy')->name('admin.logout');
    //Admin Home page after login
    Route::middleware('admin','adminnotifications')->group(function () {
        Route::get('/admin/home', 'HomeController@index')->name('admin.home');
        Route::get('/admin/profile', 'HomeController@profile')->name('admin.profile');

        // Admin Profile
        Route::post('/admin/image/update/{id}', 'HomeController@imgupdate')->name('admin.image.update');
        Route::put('/admin/password/update/{id}', 'HomeController@passupdate')->name('admin.password.update');
        Route::put('/admin/profile/update/{id}', 'HomeController@update')->name('admin.profile.update');

        // User Submitted Mail
        Route::get('/admin/user/email', 'HomeController@all_mail')->name('user.mail.list');
        Route::get('/admin/user/sent/email', 'HomeController@all_admin_sent_mail')->name('user.mail.sent.list');
        Route::get('/admin/user/email/show/{id}', 'HomeController@mail_show')->name('user.mail.show');
        Route::get('/admin/user/email/compose', 'HomeController@compose')->name('user.mail.compose');
        Route::post('/admin/user/email/send', 'HomeController@send')->name('user.mail.send');

        Route::delete('/admin/email/delete/{id}', 'HomeController@mail_destroy')->name('email.delete');
        Route::post('/admin/email/delete/{slug}/all', 'HomeController@deleteAll')->name('email.alldelete');


        // Subscriber List Route
        Route::get('/admin/subscribers', 'HomeController@subscribers')->name('subscribers.list');
        Route::get('/admin/subscriber/send-email', 'HomeController@subscriber_mail')->name('subscriber_send_email');
        Route::post('/admin/subscriber/send-email-submit', 'HomeController@subscribers_mail_send')->name('subscriber_send_email_submit');
        Route::delete('/admin/subscribers/delete/{id}', 'HomeController@subscribers_delete')->name('subscribers.delete');

        //website Customer List Route
        Route::get('/admin/customers/list/', 'HomeController@create')->name('customers.list');
        Route::put('/admin/user/profile/status/{id}', 'HomeController@status')->name('user.profile.status');
        Route::get('/admin/user/profile/show/{id}', 'HomeController@show')->name('user.profile.show');
        Route::get('/admin/user/mlmuser/{id}', 'HomeController@check')->name('user.mlmuser.check');

        // Cache Clear Route
        Route::get('/admin/cache/clear', 'HomeController@cache')->name('cache.clear');

        //digital product route
        Route::resource('/admin/digitalproduct','DigitalProductController');
        Route::put('/admin/digitalproduct/status/{id}','DigitalProductController@status')->name('digital.product.status');

        // Order route
        Route::resource('/admin/orders','OrdersController');
        Route::put('/admin/orders/payment/status/{id}', 'OrdersController@payment_status')->name('orders.payment_status');
        Route::post('/admin/orders/payment/orderStatus/{id}', 'OrdersController@orderStatus')->name('orders.orderStatus');
        Route::get('/admin/orders/type/{type}', 'OrdersController@order_type')->name('orders.type');
        Route::get('/admin/orders/customize/orders',  'OrdersController@customize_orders')->name('orders.type.customize_orders');
        Route::get('/admin/charts/data', 'OrdersController@getChartData')->name('orders.chart.data');

        Route::get('/admin/order/status/{id}/order_status/{type}', 'OrdersController@type_status')->name('orders.type_status');
        Route::get('/admin/order/invoice/print/{id}', 'OrdersController@print_invoice')->name('orders.print_invoice');

        // transactions route
        Route::resource('/admin/transections','TransectionsController');

        //main route
        Route::resource('/admin/homecontroller','HomeController');

        //Ticket route
        Route::resource('/admin/ticket','TicketController');
        Route::put('/admin/ticket/close/{uuid}','TicketController@close')->name('ticket.close');
        Route::post('admin/ticket/store', 'TicketController@ticketStore')->name('ticketStore');
        Route::resource('/admin/tickets/ticket-categories','TicketCategoryController');
        Route::resource('/admin/tickets/ticket-labels','TicketLabelController');
        Route::put('/admin/tickets/category/status/{id}','TicketCategoryController@status')->name('ticket-categories.status');
        Route::put('/admin/tickets/labels/status/{id}','TicketLabelController@status')->name('ticket-labels.status');

        //Slider route
        Route::resource('/admin/slider','SliderController');
        Route::put('/admin/slider/status/{id}','SliderController@status')->name('slider.status');

        //General Setting route
        Route::resource('/admin/setting/system','GeneralSettingController');
        Route::get('/admin/home-page','GeneralSettingController@homePage')->name('home-page.index');
        Route::put('/admin/home-page/single_type_carousal','GeneralSettingController@single_carousal')->name('single_carousal');

        Route::put('/admin/home-page/single_column','GeneralSettingController@single_column')->name('single_column');

        Route::put('/admin/home-page/double_column','GeneralSettingController@double_column')->name('double_column');
        
        Route::put('/admin/home-page/slider_products','GeneralSettingController@slider_products')->name('slider_products');

        Route::post('selected-categories', 'GeneralSettingController@selected_categoris_store')->name('selected-categories.store');

        Route::put('/admin/setting/name_customization','GeneralSettingController@app_name_customization')->name('app_name_customization');

        Route::put('/admin/setting/logo_customization','GeneralSettingController@app_logo_customization')->name('app_logo_customization');
        Route::put('/admin/setting/favicon_customization','GeneralSettingController@app_favicon_customization')->name('app_favicon_customization');

        Route::put('/admin/setting/loader_customization','GeneralSettingController@app_loader_customization')->name('app_loader_customization');

        Route::put('/admin/setting/meta_customization','GeneralSettingController@app_meta_customization')->name('app_meta_customization');

        //dynamic menu route

        Route::put('/admin/menu/status/{id}','GeneralSettingController@menu_status')->name('menu.status');
        Route::get('/admin/menu/edit/{id}','GeneralSettingController@menu_edit')->name('menu.edit');
        Route::put('/admin/menu/update/{id}','GeneralSettingController@menu_update')->name('menu.update');

        // Cookie Route
        Route::get('/admin/cookie/alert','GeneralSettingController@cookie_show')->name('cookie.show');
        Route::put('/admin/cookie/configaration','GeneralSettingController@cookie_update')->name('cookie_configaration_put');


        //Contact Route
        Route::resource('/admin/contact/dyContact', 'ContactController');


        //Social Media Dynamic Route
        Route::resource('/admin/setting/social','SocialMediaController');

        Route::put('/admin/setting/media/update','SocialMediaController@store')->name('media_data_update');

        Route::get('/admin/setting/email','SocialMediaController@email')->name('email_configuration');

        Route::put('/admin/setting/email/configaration','SocialMediaController@email_configuration')->name('email_configaration_put');

        Route::get('/admin/setting/announcement','SocialMediaController@create')->name('announcement');

        Route::put('/admin/setting/announcement/update','SocialMediaController@announcementupdate')->name('announcementupdate');

        // Faq Dynamic Route
        Route::resource('admin/faqcategory','FaqCategoryController');
        Route::put('/admin/faqcategory/status/{id}','FaqCategoryController@status')->name('faqcategory.status');

        Route::resource('admin/faq','FaqController');

        // Pages Route
        Route::resource('admin/page','PageController');
        Route::put('/admin/page/status/{id}','PageController@status')->name('page.status');

        //Social Icon Route
        Route::resource('/admin/setting/icon', 'SocialIconController');
        Route::put('/admin/icon/status/{id}','SocialIconController@status')->name('icon.status');
        //Mlm user route
        Route::resource('/admin/mlm/adminmlm','MLMController');
        Route::get('/admin/mlm/adminmlm/chat/{id}', 'MLMController@chat')->name('adminmlm.chat');
        Route::get('/admin/mlm/adminmlm/active/users', 'MLMController@active')->name('adminmlm.active');
        Route::get('/admin/mlm/adminmlm/inactive/parentinactive/users', 'MLMController@inactivebyadmin')->name('adminmlm.inactivebyadmin');
        Route::get('/admin/mlm/adminmlm/inactive/admininactive/users', 'MLMController@inactivebyparent')->name('adminmlm.inactivebyparent');

        Route::get('/admin/pay/to/user/{id}', 'MLMController@payuser')->name('pay.user');

        //message with user system route
        Route::resource('/admin/mlm/user/userchat','MessageController');

        //Offer controller 
        Route::resource('/admin/product/productoffer','OfferController');
        Route::put('/admin/product/productoffer/status/{id}','OfferController@status')->name('offer.status');
        Route::put('/admin/product/productoffer/description/{id}','OfferController@description')->name('productoffer.add.description');
        Route::get('/admin/productoffer/add/product/{id}', 'OfferController@digitalProduct')->name('productoffer.digitalproduct');
        Route::put('/admin/productoffer/add/addproduct/{id}','OfferController@adddigitalProduct')->name('productoffer.add.digitalproduct');
        Route::get('/admin/productoffer/add/user/{id}', 'OfferController@user')->name('productoffer.user');
        Route::put('/admin/productoffer/add/adduser/{id}','OfferController@associateUsersWithOffer')->name('productoffer.add.user');


        //Product Categories Route
        Route::resource('admin/product/categories','ProductCategoryController');
        Route::post('admin/product/subcategory', 'ProductCategoryController@subCat')->name('subcat');

        //Product Type Route
        Route::resource('admin/product/item/type','ProductTypeController');
        Route::put('admin/product/item/status/{id}','ProductTypeController@status')->name('type.status');
        //Product Route
        Route::resource('admin/product/item','ProductController');
        Route::get('admin/product/add', 'ProductController@add')->name('item.add');
        Route::get('admin/product/item/create', 'ProductController@create')->name('physical.product.create');
        Route::get('admin/product/item/affiliate/create', 'ProductController@affiliatecreate')->name('affiliate.product.create');
        Route::get('admin/product/item/customize/create', 'ProductController@customizecreate')->name('customize.product.create');

        Route::put('admin/product/status/{id}','ProductController@change_status')->name('item.status');

        Route::post('img_dlt', 'ProductController@img_dlt')->name('img_dlt');
        Route::get('admin/stock/out/product', 'ProductController@stockout')->name('product.stock.out');
        Route::get('admin/product/campaign', 'ProductController@campaign_offer')->name('product.campaign.offer');
        Route::put('admin/product/add/campaign/{id}','ProductController@product_campaing')->name('product.add.campaign.offer');
        Route::put('admin/product/campaign/status/{id}','ProductController@status')->name('product.campaign.status');
        Route::delete('admin/product/campaign/delete/{id}','ProductController@delete')->name('product.campaign.delete');

        Route::resource('admin/product/review','ProductReviewController');

        //Customize Product Design Route
        Route::get('admin/product/{id}/customize/design','ProductAttributeController@design_list')->name('product.customize.design');
        Route::get('admin/product/{id}/customize/create','ProductAttributeController@designcreate')->name('product.customize.design.create');
        Route::post('admin/product/{id}/customize/store','ProductAttributeController@designstore')->name('product.customize.design.store');
        Route::get('admin/product/{productId}/customize/{id}/edit','ProductAttributeController@designedit')->name('product.customize.design.edit');
        Route::put('admin/product/{productId}/customize/{id}/update','ProductAttributeController@designupdate')->name('product.customize.design.update');
        Route::delete('admin/product/customize/{id}/delete','ProductAttributeController@designdestroy')->name('product.customize.design.destroy');
        //Attribute Route
        Route::get('admin/product/{id}/attribute','ProductAttributeController@index')->name('product.attribute');
        Route::get('admin/product/{id}/attribute/options','ProductAttributeController@optionlist')->name('product.attribute.option');

        Route::get('admin/product/{id}/attribute/create','ProductAttributeController@create')->name('product.attribute.create');
        Route::get('admin/product/{id}/attribute/create/option','ProductAttributeController@optioncreate')->name('product.attribute.option.create');

        Route::get('admin/product/{productId}/attribute/{id}/edit','ProductAttributeController@edit')->name('product.attribute.edit');
        Route::get('admin/product/{productId}/attribute/{id}/edit/option','ProductAttributeController@editoption')->name('product.attribute.option.edit');
        Route::get('admin/product/{productId}/attribute/{id}/connect/option','ProductAttributeController@connect')->name('product.attribute.option.connect');

        Route::post('admin/product/{id}/attribute/store','ProductAttributeController@store')->name('product.attribute.store');
        Route::post('admin/product/{id}/attribute/option/store','ProductAttributeController@optionstore')->name('product.attribute.option.store');

        Route::post('admin/product/{productId}/attribute/{id}/update','ProductAttributeController@update')->name('product.attribute.update');
        Route::post('admin/product/{productId}/attribute/{id}/option/update','ProductAttributeController@optionupdate')->name('product.attribute.option.update');

        Route::resource('admin/product/attribute', 'ProductAttributeController');

        Route::delete('admin/product/option{id}', 'ProductAttributeController@optiondestroy')->name('product.attribute.option.destroy');


        // Product Import And Export Route
        Route::get('/admin/product/export', 'ProductController@export')->name('product.export');
        Route::post('/admin/product/import', 'ProductController@import')->name('product.import');
        Route::get('/admin/bulk/product/index', 'ProductController@imexport')->name('product.import.export');

        //Coupon Route
        Route::resource('/admin/coupon/code','CouponController');
        Route::put('/admin/coupon/status/{id}','CouponController@status')->name('code.status');

        //Shipping Route
        Route::resource('/admin/shipping', 'ShippingController');
        Route::put('/admin/shipping/status/{id}','ShippingController@status')->name('shipping.status');

        //Payment Gateway Route
        Route::resource('/admin/setting/payment', 'PaymentController');

        Route::resource('roles', 'RoleController');
        Route::resource('admins', 'AdminController');
        Route::resource('permissions', 'PermissionController');

    });
});

require __DIR__.'/auth.php';
