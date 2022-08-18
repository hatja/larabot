<?php

namespace App\Repositories;


use App\Models\User;
use App\Models\Watcher;
use App\Interfaces\WatcherRepositoryInterface;

class EloquentWatcherRepository implements WatcherRepositoryInterface
{
    public function getAllByUser(User $user)
    {
        return $user->watchers()->orderBy('order', 'asc')->get();
    }

    public function getById($watcherId)
    {
        return Watcher::findOrFail($watcherId);
    }

    public function updatePriceById($watcherId, $price)
    {
        $watcher = Watcher::findOrFail($watcherId);
        return $watcher->update(['price' => $price]);
    }

    public function updatePriceBySymbol($symbol, $price)
    {
        $watcher = Watcher::where('symbol', 'LIKE', $symbol)->firstOrFail();
        $watcher->update(['price' => $price]);

        return $watcher;
    }

    public function archivatePrice($watcherId, $price)
    {
        return Watcher::findOrFail($watcherId);
    }

    public function deleteWatcher($watcherId)
    {
        return Watcher::destroy($watcherId);
    }

    public function create(array $params)
    {
        return Watcher::create($params);
    }

   /* public function reorderUserWatchers(User $user)
    {
        $watchers = $this->getWatchersByUser($user);
        $hasOne = $watchers->where('order', '=', 1)->first();
        if ($hasOne) {
            foreach ($watchers as $watcher) {
                $watcher->order++;
                $watcher->save();
            }
        }

    }*/
}
