<?php

return [
    //TODO: Make these editable on frontend
    'open_position_after_percent' => env('BUY_AFTER_PERCENTAGE', 1),    //buys asset if its up by 1%
    'position_value' => env('POSITION_VALUE', 100),     //USD amount of a transaction
    'close_position_after_percent' => env('SELL_AFTER_PERCENTAGE', 1),  //Sell asset with 1% profit
    'stop_loss_limit_percent' => env('STOP_LOSS_LIMIT_PERCENTAGE', 5),  //Sell asset with 5% lose
];
