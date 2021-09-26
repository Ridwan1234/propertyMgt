<?php

namespace App\Providers;

use App\Events\LeaseCreatedEvent;
use App\Events\PropertyCreatedEvent;
use App\Events\PropertyLeasesEvent;
use App\Listeners\GenerateInvoiceListener;
use App\Listeners\GenerateLeaseInvoice;
use App\Listeners\MarkPropertyAsOccupied;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        LeaseCreatedEvent::class => [
            GenerateInvoiceListener::class,
        ]

//        PropertyLeasesEvent::class => [
//            MarkPropertyAsOccupied::class,
//            GenerateLeaseInvoice::class,
//        ],
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
