<?php

namespace App\Services;

use App\Events\OrderPlaced;
use App\Http\Resources\OrderResource;
use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\User;
use App\Models\Watcher;
use Binance\API;

class OrderService
{

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        //$this->user = $user;
        $this->api = resolve(API::class);
        $this->config = config('trade');
        $this->orderRepository = $orderRepository;
    }

    public function openPosition(User $user, Watcher $watcher)
    {
        $usdValue = $this->config['position_value'];
        $quantity = round($usdValue / $watcher->price, 2);
        $binanceOrder = $this->api->marketBuy($watcher->symbol, $quantity);
        if ($binanceOrder && $order = $this->orderRepository->create($user, $watcher, Order::SIDE_BUY, $binanceOrder)) {
            $orderResource = new OrderResource($order);
            event(new OrderPlaced($user, $orderResource));
        } else {
            throw new \Exception('Something bad happened during the buy');
        }
    }

    public function tryToOpenByWatcher(Watcher $watcher)
    {
        if ($watcher->changePercentageSinceStored >= $this->config['open_position_after_percent']) {
            //Get users whom dont have open position in the given asset AND dont have closed position either in the past hour
            $usersToBuyFor = $watcher->users()
                ->whereHas('openOrders', function ($q) use ($watcher) {
                    $q->where('watcher_id', $watcher->id);
                }, '=', 0)
                ->whereHas('closedOrders', function ($q) use ($watcher) {
                    $q->where('watcher_id', $watcher->id)->whereDate('closed_at', '>', now()->subHour());
                }, '=', 0)
                ->get();
            foreach ($usersToBuyFor as $userToBuyFor) {
                $this->openPosition($userToBuyFor, $watcher);
            }

        }
    }


    public function tryToClose($orders)
    {
        foreach (collect($orders) as $order) {

        }
    }

}
