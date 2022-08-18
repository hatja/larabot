<?php


namespace App\Interfaces;

use App\Models\User;
use App\Models\Watcher;

interface OrderRepositoryInterface
{
    public function getAll();
    public function getAllByUser(User $user);
    public function getById($orderId);
    public function updateById($watcherId, $price);
    public function create(User $user, Watcher $watcher,string $type, array $params);
    public function getAllOpened();
    public function getOpenedByWatcher(Watcher $watcher);
}
