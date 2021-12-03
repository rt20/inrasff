<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events as Events;
use App\Listeners as Listeners;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        Events\DownStreamEmailNotification::class => [
            Listeners\SendDownStreamNotification::class,
        ],

        Events\NotificationContactUs::class => [
            Listeners\SendNotificationContactUs::class,

        Events\UpStreamEmailNotification::class => [
            Listeners\SendUpStreamNotification::class,
        ],

        // Events\DownStreamInstitutionMailNotification::class => [
        //     Listeners\SendDownStreamNotification::class,
        // ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
