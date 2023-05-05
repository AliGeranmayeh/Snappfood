<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RestaurantCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $hidden = ['id'];
    public $timestamps = false;

    public function restaurants(): HasMany
    {
        return $this->hasMany(Restaurant::class);
    }
}
