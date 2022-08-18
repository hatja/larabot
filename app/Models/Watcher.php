<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watcher extends Model
{
    use HasFactory;

    const OLD_PRICES_LIMIT = 25;  //how many old ticks should be stored

    protected static function boot()
    {
        parent::boot();


        /*    static::addGlobalScope('order', function (Builder $builder) {
                $builder->orderBy('order');
            });*/
    }

    protected $casts = [
        'old_prices' => 'array',
    ];

    protected $fillable = [
        'symbol', 'price', 'price_updated'
    ];

    public $dates = [
        'created_at', 'updated_at'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('order')
            ->withTimestamps();
    }

    public function archivatePrice(array $original)
    {
        $oldPriceObj = [
            'time' => $original['price_updated'],
            'price' => $original['price']
        ];
        $oldPricesArr = $this->old_prices;
        array_unshift($oldPricesArr, $oldPriceObj);
        $this->old_prices = array_splice($oldPricesArr, 0, self::OLD_PRICES_LIMIT);
    }

    public function oldPriceChangeData($index = null): ?array
    {
        $oldestStoredPriceArr = $this->old_prices ?: [];
        $oldestStoredPrice = !empty($oldestStoredPriceArr) ? array_pop($oldestStoredPriceArr)['price'] : null;
        if ($index === null) {
            if (isset($this->old_prices[0])) {
                $priceToCompare = $this->price;
                $olderPriceToCompareWith = $this->old_prices[0]['price'];
            }
        } else {
            $priceToCompare = $this->old_prices[$index]['price'];
            if (isset($this->old_prices[$index + 1])) {
                $olderPriceToCompareWith = $this->old_prices[$index + 1]['price'];
            }
        }
        if (isset($olderPriceToCompareWith) && isset($priceToCompare)) {
            $changeData['movement'] = $priceToCompare >= $olderPriceToCompareWith ? 'UP' : 'DOWN';
            $changeData['difference'] = $priceToCompare - $oldestStoredPrice;
            $changeData['percentage'] = round(($changeData['difference'] / $oldestStoredPrice) * 100, 2);

            return $changeData;
        }
        return null;
    }

    public function getChangePercentageSinceStoredAttribute(): float|int
    {
        $currentPrice = $this->price;
        $oldestStoredPriceArr = $this->old_prices ?: [];
        if(!empty($oldestStoredPriceArr)) {
            $oldestStoredPrice = array_pop($oldestStoredPriceArr)['price'];
            $difference = $currentPrice - $oldestStoredPrice;
            return round(($difference / $oldestStoredPrice) * 100, 2);
        }
        return 0;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
