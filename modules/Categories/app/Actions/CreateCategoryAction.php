<?php

namespace Modules\Categories\app\Actions;

use Modules\Categories\app\Models\Category;

class CreateCategoryAction
{

    public function __invoke($title)
    {
        Category::create([
            'title' => $title,
            'user_id' => auth()->user()->id
        ]);
    }

}