<?php

namespace App\Repositories;


use App\Models\Order;
use App\Models\User;
use App\Models\Watcher;
use App\Interfaces\OrderRepositoryInterface;

class EloquentOrderRepository implements OrderRepositoryInterface
{
    public function getAll()
    {

    }

    public function getAllByUser(User $user)
    {

    }

    public function getById($orderId)
    {

    }

    public function updateById($watcherId, $price)
    {

    }
    public function create(User $user, Watcher $watcher, string $side, array $params)
    {
        $order = new Order;
        $order->user()->associate($user);
        $order->watcher()->associate($watcher);
        $order->side = $side;
        $order->status = $params['status'];
        if (isset($params['fills'])) {
            $order->amount = $params['fills']['qty'];
            $order->price = $params['fills']['price'];
        } else {
            $order->amount = $params['executedQty'];
            $order->price = $watcher->price;
        }
        $order->value = $params['cummulativeQuoteQty'];
        $order->binance_data = $params;
        $order->save();
        return $order;
    }

    public function getAllOpened()
    {

    }
    public function getOpenedByWatcher(Watcher $watcher)
    {
        return $watcher->orders()->opened()->get();
    }
}
