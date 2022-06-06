<?php

namespace Modules\Likes\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Likes\database\factories\LikeFactory;
use Modules\Tweets\app\Models\Tweet;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'tweet_id',
        'user_id'
    ];

    public function tweet() {
        return $this->belongsTo(Tweet::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    protected static function newFactory()
    {
        return LikeFactory::new();
    }
}