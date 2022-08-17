<?php

namespace App\Repositories;


use App\Models\User;
use App\Models\Watcher;

class WatcherRepository
{
    public function getWatchersByUser(User $user)
    {
        return $user->watchers()->orderBy('order', 'asc')->get();
    }

    public function getWatcherById($watcherId)
    {
        return Watcher::findOrFail($watcherId);
    }

    public function updateWatcher($watcherId, $params)
    {
        $watcher = Watcher::findOrFail($watcherId);
        return $watcher->update($params);
       /* foreach($params as $key => $val) {
            $watcher->$key = $val;
            $watcher->save();
        }*/
    }

    public function archivatePrice($watcherId, $price)
    {
        return Watcher::findOrFail($watcherId);
    }

    public function deleteWatcher($watcherId)
    {
        return Watcher::destroy($watcherId);
    }

    public function createWatcher(User $user, string $symbol)
    {
        return Watcher::create(['user_id' => $user->id, 'symbol' => $symbol]);
    }

    public function reorderUserWatchers(User $user)
    {
        $watchers = $this->getWatchersByUser($user);
        $hasOne = $watchers->where('order', '=', 1)->first();
        if ($hasOne) {
            foreach ($watchers as $watcher) {
                $watcher->order++;
                $watcher->save();
            }
        }

    }
}
