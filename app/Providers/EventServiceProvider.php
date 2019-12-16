<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

/**
 * The event service provider.
 */
class EventServiceProvider extends ServiceProvider
{
    /** @var array $listen The event listener mappings for the application. */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void Returns nothing.
     */
    public function boot()
    {
        parent::boot();
    }
}
