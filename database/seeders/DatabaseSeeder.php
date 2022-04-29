<?php

namespace Database\Seeders;

use App\Models\Favourite;
use App\Models\Follower;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Reply;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)->create();
        Tweet::factory(200)->create();
        Reply::factory(300)->create();
        Like::factory(300)->create();
        Follower::factory(300)->create();
        Favourite::factory(200)->create();
    }
}
