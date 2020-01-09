<?php

namespace App\Providers;

use App\Events\EmailNotification;

use App\Listeners\SendEmail;
use App\Listeners\DatabaseNotification;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        EmailNotification::class => [
            SendEmail::class
        ],
        'Illuminate\Notifications\Events\NotificationSent' => [
            DatabaseNotification::class
        ]

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

}
