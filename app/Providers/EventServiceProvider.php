<?php

namespace App\Providers;

use App\Events\OrderEvent;
use App\Listeners\DeductProductQuantityListener;
use App\Listeners\EmptyCartListener;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrderEvent::class => [
            DeductProductQuantityListener::class,
            EmptyCartListener::class,
        ],
    ];
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
        //
    }
}
