<?php

namespace Modules\Categories\app\Models;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Categories\database\factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tweets() {
        return $this->hasMany(Tweet::class);
    }

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }
}
