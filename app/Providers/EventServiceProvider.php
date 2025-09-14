<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Console\Scheduling\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        parent::boot();

        Event::listen(Login::class, function ($event) {
            if ($event->guard === 'admin') {
                activity()
                    ->causedBy($event->user)
                    ->log('Admin logged in');
            }
        });

        Event::listen(Logout::class, function ($event) {
            if ($event->guard === 'admin') {
                activity()
                    ->causedBy($event->user)
                    ->log('Admin logged out');
            }
        });
    }
}
