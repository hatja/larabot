<?php

namespace App\Providers;

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
        // $this->api = new \Binance\API($key,$secret, true);
        $this->app->singleton(API::class, function ($app) use ($apiKey, $apiSecret) {
            return new API($apiKey, $apiSecret, true);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('uniqueWith', function ($attribute, $value, $parameters) {

            $already = \DB::table($parameters[0])
                ->where($parameters[1], 'LIKE', $value)
                ->where($parameters[2], $parameters[3])
                ->whereNull('deleted_at')
                ->count();

            return $already == 0;
        });
    }
}
