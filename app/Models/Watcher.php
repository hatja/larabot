<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Watcher extends Model
{
    use HasFactory, SoftDeletes;

    const OLD_PRICES_LIMIT = 20;  //how many old ticks should be stored

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order');
        });
    }

    protected $casts = [
        'old_prices' => 'array',
    ];

    protected $fillable = [
        'symbol','user_id'
    ];

    public $dates = [
        'created_at', 'updated_at', 'deleted_at', 'price_updated'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
