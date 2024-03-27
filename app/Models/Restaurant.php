<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'name',
        'account',
        'user_id',
        'type_id',
        'address'
    ];

    protected $hidden = [
        'user_id',
        'type_id',

    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(RestaurantCategory::class);
    }

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }


    public function scopeThisRestaurant($query)
    {
        return $query->where('user_id',Auth::user()->id);
    }
}

