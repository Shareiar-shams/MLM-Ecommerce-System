<?php

namespace App\Providers;

use App\Models\Admin\Announcement;
use App\Models\Admin\Cookie;
use App\Models\Admin\EmailConfig;
use App\Models\Admin\IndexDynamicData;
use App\Models\Admin\Menu;
use App\Models\Admin\Page;
use App\Models\Admin\PaymentGateway;
use App\Models\Admin\Product;
use App\Models\Admin\Setting;
use App\Models\Admin\SocialIcon;
use App\Models\Admin\SocialMedia;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        // Get the application name dynamically from the configuration or any other source
        $appName = Setting::value('app_name') ?? config('app.name');
        // Modify the application name dynamically
        config(['app.name' => $appName]);

        View::share('logoPath', \Storage::disk('local')->url(Setting::value('logo')) ?? asset('viewport/img/new-logo.png'));

        View::share('favicon', \Storage::disk('local')->url(Setting::value('favicon')) ?? asset('viewport/img/favicon.png'));

        View::share('loader', \Storage::disk('local')->url(Setting::value('loader')) ?? asset('viewport/img/loader.png'));

        View::share('display_loader',Setting::value('display_loader') ?? false);

        
        View::share('home_page_title',Setting::value('home_page_title') ?? 'Ahknoxo | E-commerce');

        View::share('banner',Announcement::first() ?? []);

        View::share('single_banner', IndexDynamicData::where('mapping', 'single_column')->first() ?? []);

        View::share('cookie', Cookie::where('status', 1)->first() ?? []);

        View::composer('*', function($view)
        {
            $menu = Menu::where('status',1)->orderBy('ordering')->get();
            $view->with('menus', $menu);
        });

        View::composer('*', function($view)
        {
            $pages = Page::where('status',1)->orderBy('id','ASC')->get();
            $view->with('pages', $pages);
        });

        View::composer('*', function($view)
        {
            $icons = SocialIcon::where('status',1)->orderBy('id','ASC')->get();
            $view->with('icons', $icons);
        });
        // Recent Item
        View::composer('*', function($view)
        {
            $topRatedProducts = Product::where('status',true)->where('productType', '!=', 'customize')
                ->with('reviews')
                ->select('products.*')
                ->leftJoin('reviews', 'reviews.product_id', '=', 'products.id')
                ->groupBy('products.id')
                ->orderByRaw('AVG(reviews.rating) DESC')
                ->limit(3)
                ->get();
            $view->with('topRatedProducts', $topRatedProducts);
        });

        // Assuming you have a model for the social media table

        $facebookData = SocialMedia::where('media_name','Facebook')->first();
        $googleData = SocialMedia::where('media_name','Google')->first();

        putenv("FACEBOOK_CLIENT_ID={$facebookData->app_id}");
        putenv("FACEBOOK_CLIENT_SECRET={$facebookData->app_secret}");
        putenv("FACEBOOK_REDIRECT_URL={$facebookData->redirect_url}");

        putenv("GOOGLE_CLIENT_ID={$googleData->app_id}");
        putenv("GOOGLE_CLIENT_SECRET={$googleData->app_secret}");
        putenv("GOOGLE_REDIRECT_URL={$googleData->redirect_url}");

        //bKash configuration from database
        $bkash = PaymentGateway::where('slug','bkash')->where('status', 1)->first();
        $bKashdata = isset($bkash->data) ? json_decode($bkash->data, true) : '';
        if($bkash && $bKashdata){

            putenv("BKASH_SANDBOX=" . ($bkash->sandbox == 1 ? 'true' : 'false'));
            putenv("BKASH_APP_KEY={$bKashdata['app_key']}");
            putenv("BKASH_APP_SECRET={$bKashdata['app_secret']}");
            putenv("BKASH_USERNAME={$bKashdata['username']}");
            putenv("BKASH_PASSWORD={$bKashdata['password']}");
            putenv("BKASH_CALLBACK_URL={$bKashdata['callback_url']}");
        }


        //stripe configuration from database
        $stripe = PaymentGateway::where('slug','stripe')->where('status', 1)->first();
        $stripedata = isset($stripe->data) ? json_decode($stripe->data, true) : '';
        if($stripe && $stripedata){
            putenv("STRIPE_KEY={$stripedata['key']}");
            putenv("STRIPE_SECRET={$stripedata['secret']}");
        }

        //paypal configuration from database
        $paypal = PaymentGateway::where('slug','paypal')->where('status', 1)->first();
        $paypaldata = isset($paypal->data) ? json_decode($paypal->data, true) : '';
        if($paypal && $paypaldata){
            putenv("PAYPAL_MODE=" . ($paypal->sandbox == 1) ? 'sandbox' : 'live');  #for production use live
            putenv("PAYPAL_CLIENT_ID={$paypaldata['client_id']}");
            putenv("PAYPAL_SECRET={$paypaldata['client_secret']}");
        }


        //paypal configuration from database
        $ssl = PaymentGateway::where('slug','ssl')->where('status', 1)->first();
        $ssldata = isset($ssl->data) ? json_decode($ssl->data, true) : '';
        if($ssl && $ssldata){
            putenv("SSLCOMMERZ_SANDBOX=" . ($ssl->sandbox == 1) ? 'true' : 'false');  #for production use false
            putenv("SSLCOMMERZ_STORE_ID={$ssldata['store_id']}");
            putenv("SSLCOMMERZ__STORE_PASSWORD={$ssldata['store_password']}");
        }


        // Retrieve email configuration from database
        $emailConfig = EmailConfig::first();

        if ($emailConfig) {
            // Set environment variables
            putenv("MAIL_MAILER=" . $emailConfig->driver);
            putenv("MAIL_HOST=" . $emailConfig->host);
            putenv("MAIL_PORT=" . $emailConfig->port);
            putenv("MAIL_USERNAME=" . $emailConfig->email_username);
            putenv("MAIL_PASSWORD=" . $emailConfig->email_password);
            putenv("MAIL_ENCRYPTION=" . $emailConfig->encryption);
            putenv("MAIL_FROM_ADDRESS=" . $emailConfig->sendermail);
            // You can set other environment variables here if needed
        }

        // Update service configuration (optional)
        config([
            'mail.mailers.smtp.host' => env('MAIL_HOST'),
            'mail.mailers.smtp.port' => env('MAIL_PORT'),
            'mail.mailers.smtp.username' => env('MAIL_USERNAME'),
            'mail.mailers.smtp.password' => env('MAIL_PASSWORD'),
            'mail.mailers.smtp.encryption' => env('MAIL_ENCRYPTION'),
            'mail.from.address' => env('MAIL_FROM_ADDRESS'),
            // Update other mail service configuration values here if needed

            'bkash.sandbox' => env('BKASH_SANDBOX'),
            'bkash.bkash_app_key' => env('BKASH_APP_KEY'),
            'bkash.bkash_app_secret' => env('BKASH_APP_SECRET'),
            'bkash.bkash_username' => env('BKASH_USERNAME'),
            'bkash.bkash_password' => env('BKASH_PASSWORD'),
            'bkash.callbackURL' => env('BKASH_CALLBACK_URL'),
        ]);

    }
}
