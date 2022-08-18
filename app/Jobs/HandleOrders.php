<?php

namespace App\Jobs;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Watcher;
use App\Services\OrderService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HandleOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Watcher $watcher;
    private OrderRepositoryInterface $orderRepository;

    /**
     * Create a new job instance.
     *
     * @param Watcher $watcher
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(Watcher $watcher, OrderRepositoryInterface $orderRepository)
    {
        $this->watcher = $watcher;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Execute the job.
     *
     * @param OrderService $orderService
     * @return void
     */
    public function handle(OrderService $orderService)
    {
        //first try to close the pending positions
        $openOrders = $this->orderRepository->getOpenedByWatcher($this->watcher);
        $orderService->tryToClose($openOrders);

        //then we can manage the new ones
        $orderService->tryToOpenByWatcher($this->watcher);
       /* foreach($openOrders as $openOrder) {
            $orderService->tryToClose($openOrder);
        }*/
    }
}
