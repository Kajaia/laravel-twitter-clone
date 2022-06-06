<?php

namespace Modules\Favourites\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Favourites\database\factories\FavouriteFactory;
use Modules\Tweets\app\Models\Tweet;

class Favourite extends Model
{
    use HasFactory;

    protected $fillable = [
        'tweet_id',
        'user_id'
    ];

    public function tweets() {
        return $this->hasMany(Tweet::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }

    protected static function newFactory()
    {
        return FavouriteFactory::new();
    }
}