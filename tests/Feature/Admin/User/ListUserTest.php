<?php

namespace Tests\Feature\Admin\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Admin\TestCase;
use App\Models\User;

class ListUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User with permission can access the list users page
     *
     * @return void
     */
    public function test_user_with_permission_can_access_the_list_users_page()
    {
        $this->loginAsAdmin();

        $response = $this->get('/a/users');

        $response->assertStatus(200);
    }

    /**
     * User without permission cannot access the list users page
     *
     * @return void
     */
    public function test_user_without_permission_cannot_access_the_list_users_page()
    {
        $this->loginAsUser();

        $response = $this->get('/a/users');

        $response->assertStatus(403);
    }

    /**
     * User with permission can access the view an individual user
     *
     * @return void
     */
    public function test_user_with_permission_can_access_view_an_individual_user()
    {
        $this->loginAsAdmin();

        $user = User::factory()->create();

        $response = $this->get("/a/users/{$user->id}");

        $response->assertStatus(200);
    }

    /**
     * User without permission cannot view an individual user
     *
     * @return void
     */
    public function test_user_without_permission_cannot_view_an_individual_user()
    {
        $this->loginAsUser();

        $user = User::factory()->create();

        $response = $this->get("/a/users/{$user->id}");

        $response->assertStatus(403);
    }
}
