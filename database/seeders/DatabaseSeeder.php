<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Categories\database\seeders\CategorySeeder;
use Modules\Favourites\database\seeders\FavouriteSeeder;
use Modules\Likes\database\seeders\LikeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            TweetSeeder::class,
            LikeSeeder::class,
            FollowerSeeder::class,
            FavouriteSeeder::class
        ]);
    }
}
