<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
