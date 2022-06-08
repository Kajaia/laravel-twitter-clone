<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_get_profile_information()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user)->getJson('/api/v1/me');

        $response->assertStatus(200);
    }

    public function test_user_can_get_following_users_list()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user)->getJson('/api/v1/me/following');

        $response->assertStatus(200);
    }

    public function test_user_can_get_followers_list()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user)->getJson('/api/v1/me/follows');

        $response->assertStatus(200);
    }

    public function test_user_can_get_his_or_her_tweets()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user)->getJson('/api/v1/tweets');

        $response->assertStatus(200);
    }

    public function test_user_can_make_a_tweet()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user)
            ->postJson('/api/v1/tweets', ['content' => 'Lorem ipsum dolor...']);

        $response->assertStatus(201);
    }

    public function test_user_can_view_tweet_by_id()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user)->getJson('/api/v1/tweets/1');

        $response->assertStatus(200);
    }

    public function test_user_can_view_specific_tweet_replies()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user)->getJson('/api/v1/tweets/1/replies');

        $response->assertStatus(200);
    }

    public function test_user_can_like_specific_tweet()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user)->postJson('/api/v1/tweets/1/like');

        $response->assertStatus(201);
    }

    public function test_user_can_unlike_specific_tweet()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user)->deleteJson('/api/v1/tweets/1/unlike');

        $response->assertStatus(200);
    }

    public function test_user_can_reply_on_a_specific_tweet()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user)
            ->postJson('/api/v1/tweets/1/reply', [
                'content' => 'Dolore ipsem...',
                'tweet_id' => 1
            ]);

        $response->assertStatus(201);
    }
}