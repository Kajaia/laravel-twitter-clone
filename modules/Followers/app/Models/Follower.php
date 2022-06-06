<?php

namespace Modules\Followers\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Followers\database\factories\FollowerFactory;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = [
        'follower_id',
        'followed_id'
    ];

    public function follower() {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function following() {
        return $this->belongsTo(User::class, 'followed_id');
    }

    protected static function newFactory()
    {
        return FollowerFactory::new();
    }
}