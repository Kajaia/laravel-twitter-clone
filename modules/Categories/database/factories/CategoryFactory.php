<?php

namespace Modules\Categories\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Categories\app\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'user_id' => $this->faker->numberBetween(1, 100)
        ];
    }
}
