<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered as EventsRegistered;
//use Illuminate\Support\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    protected $listen = [EventsRegistered::class => [SendEmailVerificationNotification::class],];
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function shouldDiscoverEvents() : bool
    {
        return false;
    }
}
