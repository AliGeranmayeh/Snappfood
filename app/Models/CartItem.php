<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_id',
        'food_name',
        'food_price' ,
        'food_discount' ,
        'food_count',
        'cart_id'
        ];
        protected $hidden = [
            'created_at',
            'updated_at',
            'cart_id'
        ];
        public function item(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
}
