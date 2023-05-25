<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'restaurant_id',
        'order_id',
        'comment',
        'confirmation',
        'delete_request'
    ];
}
