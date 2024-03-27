<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Http\Requests\DiscountRequest;
use Illuminate\Support\Facades\Auth;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'materials',
        'discount_id',
        'type_id',
        'restaurant_id'
    ];

    protected $hidden = [
        'discount_id',
        'type_id',
        'restaurant_id' 
    ];
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(FoodCategory::class);
    }

    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }


    public function scopeForCurrentRestaurant($query)
    {
        $restaurantId = Auth::user()->restaurant->id;
        return $query->where('restaurant_id', $restaurantId);
    }
}
