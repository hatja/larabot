<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    const SIDE_BUY = 'BUY';
    const SIDE_SELL = 'SELL';

    public $dates = [
        'created_at', 'updated_at', 'deleted_at', 'closed_at'
    ];

    protected $casts = [
        'binance_data' => 'array'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function watcher()
    {
        return $this->belongsTo(Watcher::class);
    }

    //
    public function openOrder()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function closeOrder()
    {
        return $this->hasOne(self::class, 'parent_id');
    }

    public function scopeClosed($query)
    {
        $query->has('closeOrder');
    }

    public function scopeOpened($query)
    {
        $query->has('openOrder');
    }
}
