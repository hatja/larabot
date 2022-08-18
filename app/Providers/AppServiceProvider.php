<?php

namespace App\Providers;

use App\Helpers\SessionHelper;
use App\Services\OrderService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Binance\API;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $apiKey = config('binance.testnet_key');
        $apiSecret = config('binance.testnet_secret');
        //TODO: Should be seperate for each User with their key
        $this->app->singleton(API::class, function ($app) use ($apiKey, $apiSecret) {
            return new API($apiKey, $apiSecret, true);
        });
        $this->app->singleton(SessionHelper::class, function () {
            return new SessionHelper;
        });

        $this->app->bind(OrderService::class, function ($user) {
            return new OrderService($user);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
