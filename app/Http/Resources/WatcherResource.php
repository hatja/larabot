<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WatcherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $oldPriceObj = isset($this->old_prices[0]) ? $this->old_prices[0] : null;
        return [
            'id' => $this->id,
            'price' => $this->price,
            'old_prices' => $this->old_prices,
            'color' => $oldPriceObj && ($this->price >= $oldPriceObj['price']) ? 'green' : 'red',
            'main_price_change_data' => $this->oldPriceChangeData(),
            'table_row_html' => view('partials._watcher_history_row', [
                'i' => 0,
                'oldPrice' => $oldPriceObj,
                'watcher' => $this
            ])->render()
        ];
    }
}
