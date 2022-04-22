<?php

namespace Database\Seeders;

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
        User::factory(500)->create();
        Tweet::factory(1000)->create();
        Reply::factory(10000)->create();
        Like::factory(1000)->create();
        Notification::factory(1000)->create();
        Follower::factory(500)->create();
    }
}
