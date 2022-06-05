<?php

namespace Modules\Favourites\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Favourites\app\Models\Favourite;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Favourite>
 */
class FavouriteFactory extends Factory
{
    protected $model = Favourite::class;
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
