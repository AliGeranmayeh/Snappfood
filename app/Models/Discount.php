<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'percentage'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }


    public function scopeGetFoodParty($query)
    {
        return $query->where('name', 'Food Party');
    }

    //this scope only works with single admin
    public function scopeAvailableDiscounts($query)
    {
        $current_user = Auth::user()->id;
        $admin_user = User::where('role',UserRoleEnum::ADMIN->value)->first()->id;
        return $query->whereIn('user_id' , [$current_user, $admin_user]);
    }

}
