<?php

namespace Modules\Tweets\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Tweets\app\Models\Tweet;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tweet>
 */
class TweetFactory extends Factory
{
    protected $model = Tweet::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => $this->faker->text(140),
            'user_id' => $this->faker->numberBetween(1, 100),
            'category_id' => $this->faker->numberBetween(1, 5)
        ];
    }
}