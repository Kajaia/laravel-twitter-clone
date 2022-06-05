<?php

namespace Modules\Likes\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Likes\app\Models\Like;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    protected $model = Like::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tweet_id' => $this->faker->numberBetween(1, 200),
            'user_id' => $this->faker->numberBetween(1, 100)
        ];
    }
}
