<?php

namespace Modules\Tweets\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Categories\app\Models\Category;
use Modules\Favourites\app\Models\Favourite;
use Modules\Likes\app\Models\Like;
use Modules\Tweets\database\factories\TweetFactory;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'category_id',
        'tweet_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function reply() {
        return $this->belongsTo(Tweet::class, 'tweet_id');
    }

    public function replies() {
        return $this->hasMany(Tweet::class, 'tweet_id');
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function favourites() {
        return $this->hasMany(Favourite::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function getContentAttribute($value) {
        return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" class="text-decoration-none" target="_blank">$1</a>', $value);
    }

    protected static function newFactory()
    {
        return TweetFactory::new();
    }
}