<?php

namespace App\Console\Commands;

use App\Events\PriceChanged;
use App\Models\User;
use Binance\API;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

//use Binance\API as BinanceApi;

class SocketTry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'socket:try';

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
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::first();
        event(new PriceChanged($user, 'sajt'));
    }
}
