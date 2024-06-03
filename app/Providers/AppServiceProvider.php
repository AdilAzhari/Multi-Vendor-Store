<?php

namespace App\Providers;

use App\Events\OrderEvent;
use App\Listeners\DeduckProductQuantityListener;
use App\Listeners\DeductProductQuantityListener;
use App\Listeners\EmptyCartListener;
use Illuminate\Foundation\Exceptions\Renderer\Listener;
use Illuminate\Support\Facades\Event;
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
    }
}
