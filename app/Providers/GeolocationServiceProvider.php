<?php

namespace App\Providers;

use App\Services\Geolocation;
use App\Services\Map;
use App\Services\Satellite;
use Illuminate\Support\ServiceProvider;

class GeolocationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * Example https://medium.com/simform-engineering/the-power-of-laravels-service-container-a-practical-guide-5efac941b94d
     */
    public function register(): void
    {
        $this->app->bind(Geolocation::class, function ($app) {
            return new Geolocation(new Map(), new Satellite());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
