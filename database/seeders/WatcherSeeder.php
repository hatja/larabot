<?php

namespace Database\Seeders;

use App\Interfaces\WatcherRepositoryInterface;
use App\Models\Watcher;
use Binance\API;
use Illuminate\Database\Seeder;

class WatcherSeeder extends Seeder
{
    protected $api;
    protected WatcherRepositoryInterface $watcherRepository;

    public function __construct(WatcherRepositoryInterface $watcherRepository)
    {
        $this->api = resolve(API::class);
        $this->watcherRepository = $watcherRepository;

    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Watcher::truncate();
        $assets = $this->api->prices();
        foreach ($assets as $symbol => $price) {
            $this->watcherRepository->create(compact('symbol', 'price'));
        }
        // \App\Models\User::factory(10)->create();
    }
}
