<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restaurant_id',
        'food_id',
        'food_name',
        'price',
        'payment_status',
        'food_name',
        'count'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
