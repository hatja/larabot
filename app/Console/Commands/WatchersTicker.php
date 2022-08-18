<?php

namespace App\Console\Commands;

use App\Events\PriceChanged;
use App\Helpers\SessionHelper;
use App\Http\Resources\WatcherResource;
use App\Interfaces\WatcherRepositoryInterface;
use Binance\API;
use Illuminate\Console\Command;

class WatchersTicker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'watchers:tick';

    protected $api;
    protected WatcherRepositoryInterface $watcherRepository;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     * @param WatcherRepositoryInterface $watcherRepository
     */
    public function __construct(WatcherRepositoryInterface $watcherRepository)
    {
        parent::__construct();
        $this->api = resolve(API::class);
        $this->watcherRepository = $watcherRepository;

    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Check active sessions in the last 30minutes, if there is none, we dont have to update
        $activeSessions = SessionHelper::usersWithinMinutes(30)->count() > 0;
        if ($activeSessions) {
            $ticker = $this->api->prices();
            foreach ($ticker as $symbol => $price) {
                $watcher = $this->watcherRepository->updatePriceBySymbol($symbol, $price);
                $resource = new WatcherResource($watcher);
                event(new PriceChanged($resource));
            }
        }
        return 0;
    }
}
