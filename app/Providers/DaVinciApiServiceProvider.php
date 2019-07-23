<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ESHDaVinci\API\Client;

class DaVinciApiServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            return new Client(env('LASSIE_API_KEY'), env('LASSIE_API_SECRET'));
        });
    }
}
