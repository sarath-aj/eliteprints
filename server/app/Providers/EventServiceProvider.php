<?php

namespace App\Providers;

use App\Events;
use App\Listeners;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Events\Order\OrderCreated::class => [
            Listeners\Order\ProcessPayment::class,
            Listeners\Order\EmptyCart::class,
        ],

        Events\Order\OrderPaymentFailed::class => [
            Listeners\Order\MarkOrderFailed::class,
        ],

        Events\Order\OrderPaid::class => [
            Listeners\Order\MarkOrderProcessing::class,
            Listeners\Order\CreateTransaction::class,
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
