<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable = [
        'user_id',
        'restaurant_id',
        'order_id',
        'comment',
        'status',
        'parent_id',
        'cart_id'
    ];

    protected $dates = ['deleted_at'];
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function foods()
    // {
    //     return $this->belongsToMany(Food::class, 'comment_food');
    // }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::class);
    }
}
