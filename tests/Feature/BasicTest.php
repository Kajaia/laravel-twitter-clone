<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BasicTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_homepage_redirects_to_login_page_if_not_authenticated()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function test_the_homepage_is_accessible_for_authenticated_user()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }

    public function test_user_profile_is_viewable_for_everyone()
    {
        $user = User::findOrFail(1);

        $response = $this->get("/{$user->slug}");

        $response->assertStatus(200);
    }

    public function test_user_details_can_be_updated()
    {
        $user = User::findOrFail(1);

        $response = $this->actingAs($user)->post("/{$user->slug}/update");

        $response->assertStatus(302);
    }
}