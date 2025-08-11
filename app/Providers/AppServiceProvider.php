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
use Illuminate\Database\QueryException;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Set pagination to use Bootstrap
        Paginator::useBootstrap();

        // Only proceed if database is available and migrations have run
        if ($this->databaseIsReady()) {
            $this->configureApplication();
            $this->shareViewData();
            $this->registerViewComposers();
            $this->configureSocialMediaAuth();
            $this->configurePaymentGateways();
            $this->configureEmailSettings();
        }
    }

    /**
     * Check if database is ready and migrations have run
     */
    private function databaseIsReady(): bool
    {
        try {
            // Check if we can connect to database
            DB::connection()->getPdo();

            // Check if required tables exist (check a few key tables)
            $requiredTables = ['settings', 'social_media', 'payment_gateways', 'email_configs'];

            foreach ($requiredTables as $table) {
                if (!Schema::hasTable($table)) {
                    return false;
                }
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Configure application settings
     */
    private function configureApplication(): void
    {
        try {
            // Get the application name dynamically from the configuration or any other source
            $appName = Setting::value('app_name') ?? config('app.name');
            config(['app.name' => $appName]);
        } catch (QueryException $e) {
            // Fallback to default if query fails
        }
    }

    /**
     * Share common data with all views
     */
    private function shareViewData(): void
    {
        try {
            // Share logo path
            $logoPath = Setting::value('logo');
            View::share('logoPath', $logoPath ? Storage::disk('local')->url($logoPath) : asset('viewport/img/new-logo.png'));

            // Share favicon
            $favicon = Setting::value('favicon');
            View::share('favicon', $favicon ? Storage::disk('local')->url($favicon) : asset('viewport/img/favicon.png'));

            // Share loader
            $loader = Setting::value('loader');
            View::share('loader', $loader ? Storage::disk('local')->url($loader) : asset('viewport/img/loader.png'));

            // Share loader display setting
            View::share('display_loader', Setting::value('display_loader') ?? false);

            // Share home page title
            View::share('home_page_title', Setting::value('home_page_title') ?? 'Ahknoxo | E-commerce');

            // Share banner
            View::share('banner', Announcement::first() ?? []);

            // Share single banner
            View::share('single_banner', IndexDynamicData::where('mapping', 'single_column')->first() ?? []);

            // Share cookie data
            View::share('cookie', Cookie::where('status', 1)->first() ?? []);
        } catch (QueryException $e) {
            // Set default values if queries fail
            View::share('logoPath', asset('viewport/img/new-logo.png'));
            View::share('favicon', asset('viewport/img/favicon.png'));
            View::share('loader', asset('viewport/img/loader.png'));
            View::share('display_loader', false);
            View::share('home_page_title', 'Ahknoxo | E-commerce');
            View::share('banner', []);
            View::share('single_banner', []);
            View::share('cookie', []);
        }
    }

    /**
     * Register view composers
     */
    private function registerViewComposers(): void
    {
        // Menu composer
        View::composer('*', function ($view) {
            try {
                $menu = Menu::where('status', 1)->orderBy('ordering')->get();
                $view->with('menus', $menu);
            } catch (QueryException $e) {
                $view->with('menus', collect());
            }
        });

        // Pages composer
        View::composer('*', function ($view) {
            try {
                $pages = Page::where('status', 1)->orderBy('id', 'ASC')->get();
                $view->with('pages', $pages);
            } catch (QueryException $e) {
                $view->with('pages', collect());
            }
        });

        // Social icons composer
        View::composer('*', function ($view) {
            try {
                $icons = SocialIcon::where('status', 1)->orderBy('id', 'ASC')->get();
                $view->with('icons', $icons);
            } catch (QueryException $e) {
                $view->with('icons', collect());
            }
        });

        // Top rated products composer
        View::composer('*', function ($view) {
            try {
                $topRatedProducts = Product::where('status', true)
                    ->where('productType', '!=', 'customize')
                    ->with('reviews')
                    ->select('products.*')
                    ->leftJoin('reviews', 'reviews.product_id', '=', 'products.id')
                    ->groupBy('products.id')
                    ->orderByRaw('AVG(reviews.rating) DESC')
                    ->limit(3)
                    ->get();
                $view->with('topRatedProducts', $topRatedProducts);
            } catch (QueryException $e) {
                $view->with('topRatedProducts', collect());
            }
        });
    }

    /**
     * Configure social media authentication
     */
    private function configureSocialMediaAuth(): void
    {
        try {
            $facebookData = SocialMedia::where('media_name', 'Facebook')->first();
            $googleData = SocialMedia::where('media_name', 'Google')->first();

            if ($facebookData) {
                putenv("FACEBOOK_CLIENT_ID={$facebookData->app_id}");
                putenv("FACEBOOK_CLIENT_SECRET={$facebookData->app_secret}");
                putenv("FACEBOOK_REDIRECT_URL={$facebookData->redirect_url}");
            }

            if ($googleData) {
                putenv("GOOGLE_CLIENT_ID={$googleData->app_id}");
                putenv("GOOGLE_CLIENT_SECRET={$googleData->app_secret}");
                putenv("GOOGLE_REDIRECT_URL={$googleData->redirect_url}");
            }
        } catch (QueryException $e) {
            // Skip social media configuration if query fails
        }
    }

    /**
     * Configure payment gateways
     */
    private function configurePaymentGateways(): void
    {
        $this->configureBkash();
        $this->configureStripe();
        $this->configurePaypal();
        $this->configureSSLCommerz();
    }

    /**
     * Configure bKash payment gateway
     */
    private function configureBkash(): void
    {
        try {
            $bkash = PaymentGateway::where('slug', 'bkash')->where('status', 1)->first();

            if ($bkash && $bkash->data) {
                $bKashdata = json_decode($bkash->data, true);

                if ($bKashdata) {
                    putenv("BKASH_SANDBOX=" . ($bkash->sandbox == 1 ? 'true' : 'false'));
                    putenv("BKASH_APP_KEY={$bKashdata['app_key']}");
                    putenv("BKASH_APP_SECRET={$bKashdata['app_secret']}");
                    putenv("BKASH_USERNAME={$bKashdata['username']}");
                    putenv("BKASH_PASSWORD={$bKashdata['password']}");
                    putenv("BKASH_CALLBACK_URL={$bKashdata['callback_url']}");
                }
            }
        } catch (QueryException $e) {
            // Skip bKash configuration if query fails
        }
    }

    /**
     * Configure Stripe payment gateway
     */
    private function configureStripe(): void
    {
        try {
            $stripe = PaymentGateway::where('slug', 'stripe')->where('status', 1)->first();

            if ($stripe && $stripe->data) {
                $stripedata = json_decode($stripe->data, true);

                if ($stripedata) {
                    putenv("STRIPE_KEY={$stripedata['key']}");
                    putenv("STRIPE_SECRET={$stripedata['secret']}");
                }
            }
        } catch (QueryException $e) {
            // Skip Stripe configuration if query fails
        }
    }

    /**
     * Configure PayPal payment gateway
     */
    private function configurePaypal(): void
    {
        try {
            $paypal = PaymentGateway::where('slug', 'paypal')->where('status', 1)->first();

            if ($paypal && $paypal->data) {
                $paypaldata = json_decode($paypal->data, true);

                if ($paypaldata) {
                    putenv("PAYPAL_MODE=" . ($paypal->sandbox == 1 ? 'sandbox' : 'live'));
                    putenv("PAYPAL_CLIENT_ID={$paypaldata['client_id']}");
                    putenv("PAYPAL_SECRET={$paypaldata['client_secret']}");
                }
            }
        } catch (QueryException $e) {
            // Skip PayPal configuration if query fails
        }
    }

    /**
     * Configure SSL Commerz payment gateway
     */
    private function configureSSLCommerz(): void
    {
        try {
            $ssl = PaymentGateway::where('slug', 'ssl')->where('status', 1)->first();

            if ($ssl && $ssl->data) {
                $ssldata = json_decode($ssl->data, true);

                if ($ssldata) {
                    putenv("SSLCOMMERZ_SANDBOX=" . ($ssl->sandbox == 1 ? 'true' : 'false'));
                    putenv("SSLCOMMERZ_STORE_ID={$ssldata['store_id']}");
                    putenv("SSLCOMMERZ_STORE_PASSWORD={$ssldata['store_password']}"); // Fixed typo
                }
            }
        } catch (QueryException $e) {
            // Skip SSL Commerz configuration if query fails
        }
    }

    /**
     * Configure email settings
     */
    private function configureEmailSettings(): void
    {
        try {
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

                // Update service configuration
                config([
                    'mail.mailers.smtp.host' => $emailConfig->host,
                    'mail.mailers.smtp.port' => $emailConfig->port,
                    'mail.mailers.smtp.username' => $emailConfig->email_username,
                    'mail.mailers.smtp.password' => $emailConfig->email_password,
                    'mail.mailers.smtp.encryption' => $emailConfig->encryption,
                    'mail.from.address' => $emailConfig->sendermail,

                    // bKash configuration
                    'bkash.sandbox' => env('BKASH_SANDBOX'),
                    'bkash.bkash_app_key' => env('BKASH_APP_KEY'),
                    'bkash.bkash_app_secret' => env('BKASH_APP_SECRET'),
                    'bkash.bkash_username' => env('BKASH_USERNAME'),
                    'bkash.bkash_password' => env('BKASH_PASSWORD'),
                    'bkash.callbackURL' => env('BKASH_CALLBACK_URL'),
                ]);
            }
        } catch (QueryException $e) {
            // Skip email configuration if query fails
        }
    }
}
