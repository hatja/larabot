<?php

namespace App\Providers;

use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\WatcherRepositoryInterface;
use App\Repositories\EloquentOrderRepository;
use App\Repositories\EloquentWatcherRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WatcherRepositoryInterface::class, EloquentWatcherRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, EloquentOrderRepository::class);

        $this->app->bind(User::class, function ($user) {
            return new Transistor($app->make(PodcastParser::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
