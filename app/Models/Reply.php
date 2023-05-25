<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','comment_id','reply_comment'];

    public function Comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }
}
