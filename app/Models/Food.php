<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(FoodCategory::class);
    }
}
