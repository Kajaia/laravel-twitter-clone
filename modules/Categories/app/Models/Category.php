<?php

namespace Modules\Categories\app\Models;

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

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }
}