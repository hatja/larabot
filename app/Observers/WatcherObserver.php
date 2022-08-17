<?php

namespace App\Observers;

use App\Models\Watcher;
use App\Repositories\WatcherRepository;

class WatcherObserver
{

    public function __construct(WatcherRepository $watcherRepository)
    {
        $this->repository = $watcherRepository;
    }

    public function creating(Watcher $watcher)
    {
        $watcher->symbol = strtoupper($watcher->symbol);
        $user = $watcher->user;
        //default order is 1 so before creating push the other orders by 1, if needed
        $this->repository->reorderUserWatchers($user);
    }
}
