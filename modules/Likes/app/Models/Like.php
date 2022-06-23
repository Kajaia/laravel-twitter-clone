<?php

namespace Modules\Likes\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Likes\database\factories\LikeFactory;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'tweet_id',
        'user_id'
    ];

    protected static function newFactory()
    {
        return LikeFactory::new();
    }
}