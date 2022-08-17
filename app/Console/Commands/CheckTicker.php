<?php

namespace App\Console\Commands;

use App\Events\PriceChanged;
use App\Models\User;
use Binance\API;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

//use Binance\API as BinanceApi;

class CheckTicker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:tick';

    protected $api;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
       // $this->api = $api;

      /*  $key = config('binance.testnet_key');
        $secret = config('binance.testnet_secret');*/
        $this->api = resolve(API::class);

    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ticker = $this->api->prices(["BTCUSDT","BNBUSDT"]);
        dd($ticker);
        $user = User::first();
        event(new PriceChanged($user, 'sajt'));
        //$this->line($ticker);
        return 0;
    }
}
