<?php

namespace App\Observers;

use App\Jobs\HandleOrders;
use App\Models\Watcher;
use App\Interfaces\WatcherRepositoryInterface;
use App\Services\UserWatcherService;

class WatcherObserver
{
    public function __construct(WatcherRepositoryInterface $watcherRepository)
    {
        $this->repository = $watcherRepository;

    }

    public function creating(Watcher $watcher)
    {
        $watcher->symbol = strtoupper($watcher->symbol);
        $watcher->price_updated = now()->timestamp;
        $watcher->old_prices = [];
    }

    public function updating(Watcher $watcher)
    {
        if ($watcher->isDirty('price')) {
            $watcher->archivatePrice($watcher->getOriginal());
            $watcher->price_updated = now()->timestamp;
        }
    }

    public function updated(Watcher $watcher)
    {
        if ($watcher->isDirty('price')) {
            HandleOrders::dispatch($watcher);
        }
    }
}
