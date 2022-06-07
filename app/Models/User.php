<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Categories\app\Models\Category;
use Modules\Favourites\app\Models\Favourite;
use Modules\Followers\app\Models\Follower;
use Modules\Likes\app\Models\Like;
use Modules\Tweets\app\Models\Tweet;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'slug',
        'visibility',
        'pic',
        'bio'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tweets() {
        return $this->hasMany(Tweet::class);
    }

    public function replies() {
        return $this->hasMany(Tweet::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function followers() {
        return $this->hasMany(Follower::class, 'followed_id');
    }

    public function following() {
        return $this->hasMany(Follower::class, 'follower_id');
    }

    public function favourites() {
        return $this->hasMany(Favourite::class);
    }

    public function categories() {
        return $this->hasMany(Category::class);
    }

    public function getBioAttribute($value) {
        return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" class="text-decoration-none" target="_blank">$1</a>', $value);
    }

    public function getFollowingUsersCount()
    {
        return $this->whereHas('followers', function($query) {
                $query->where('follower_id', $this->id)
                    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            })->count();
    }

    public function getFollowersCount()
    {
        return $this->whereHas('following', function($query) {
                $query->where('followed_id', $this->id)
                    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            })->count();
    }

    public function getFollowingUsersNewTweets()
    {
        return Tweet::whereHas('user', function($query) {
                $query->whereHas('followers', function($query) {
                    $query->where('follower_id', $this->id);
                });
            })
                ->whereBetween('created_at', [Carbon::now()->subDay(), Carbon::now()])
                ->get();
    }
}