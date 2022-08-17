<?php


namespace App\Interfaces;

use App\Models\User;

interface WatcherRepositoryInterface
{
    public function getWatchersByUser(User $user);

    public function getWatcherById($watcherId);

    public function updateWatcher($watcherId, $params);

    public function archivatePrice($watcherId, $price);

    public function deleteWatcher($watcherId);

    public function createWatcher(array $params);

    public function reorderUserWatchers(User $user);
}
