<?php

namespace App\Providers;

use App\Business\Lines\LineBot;
use App\Business\PricesFetchers\PriceFetcher;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('prices', function ($app) {
            return (new PriceFetcher)->getPrices();
        });

        $this->app->singleton('line', function ($app) {
            return (new LineBot)->getBot();
        });
    }
}
