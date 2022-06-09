<?php

namespace Modules\Categories\app\Services;

use Modules\Categories\app\Models\Category;

class CategoryService
{

    public function getCategoryById($id)
    {
        return $id ? Category::findOrFail($id) : null;
    }

    public function getCategoriesByUser($userId)
    {
        return Category::where('user_id', $userId)->get();
    }

    public function getCategoriesByIds(array $ids)
    {
        return Category::whereIn('id', $ids)->get();
    }

}