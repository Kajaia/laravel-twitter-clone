<?php

namespace Modules\Tweets\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Tweets\app\Models\Tweet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TweetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tweet::factory(200)->create();
    }
}