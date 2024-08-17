<?php

namespace App\Providers;

use App\Models\Admin\Message;
use Auth;
use Illuminate\Support\ServiceProvider;
use View;

class AdminNotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $admin = Auth::guard('admin')->user();

            if ($admin) {
                $notifications = Message::where('receiver_type', 'admin')
                    ->where('receiver_id', $admin->id)
                    ->where('is_read', 0)
                    ->groupBy('sender_id')
                    ->orderBy('sender_id', 'ASC')
                    ->get();

                $view->with('notifications', $notifications);
            }
        });
    }
}