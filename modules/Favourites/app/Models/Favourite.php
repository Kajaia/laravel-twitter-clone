<?php

namespace Modules\Favourites\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Favourites\database\factories\FavouriteFactory;

class Favourite extends Model
{
    use HasFactory;

    protected $fillable = [
        'tweet_id',
        'user_id'
    ];

    protected static function newFactory()
    {
        return FavouriteFactory::new();
    }
}