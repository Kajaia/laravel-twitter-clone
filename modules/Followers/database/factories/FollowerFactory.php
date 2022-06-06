<?php

namespace Modules\Followers\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Followers\app\Models\Follower;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Follower>
 */
class FollowerFactory extends Factory
{
    protected $model = Follower::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'follower_id' => $this->faker->numberBetween(1, 100),
            'followed_id' => $this->faker->numberBetween(1, 100)
        ];
    }
}