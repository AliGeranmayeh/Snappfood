<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'cart_id',
        'order_status'
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function scopeNotDelivered($query){
        $currentRestaturant = Auth::user()->restaurant;

        return $query->
            where('restaurant_id',$currentRestaturant->id)->
            whereNot('order_status', OrderStatusEnum::DELIVERED->value);
    }

}
