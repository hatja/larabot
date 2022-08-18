<?php


namespace App\Interfaces;

use App\Models\User;

interface WatcherRepositoryInterface
{
    public function getAllByUser(User $user);

    public function getById($watcherId);

    public function updatePriceById($watcherId, $price);

    public function updatePriceBySymbol($symbol, $price);

    public function deleteWatcher($watcherId);

    public function create(array $params);
}
