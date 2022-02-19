<?php

namespace Tests\Feature\Admin\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Admin\TestCase;

class UserStatusTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User with permission can access the deactivated users page
     *
     * @return void
     */
    public function test_check_user_with_permission_can_access_the_deactivated_users_page()
    {
        $this->loginAsAdmin();

        $response = $this->get('/a/users/deactivated');

        $response->assertStatus(200);
    }

    /**
     * User without permission cannot access the deactivated users page
     *
     * @return void
     */
    public function test_user_without_permission_cannot_access_the_deactivated_users_page()
    {
        $this->loginAsUser();

        $response = $this->get('/a/users/deactivated');

        $response->assertStatus(403);
    }

    /**
     * Check user with permission deactivate user
     *
     * @return void
     */
    public function test_check_user_with_permission_deactivate_user()
    {
        $this->loginAsAdmin();

        $user = User::factory()->create();

        $response = $this->post("/a/users/{$user->id}/deactivate");

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'active' => false
        ]);

        $response->assertSessionHas(['flash_success' => 'User deactivating successfully.']);
    }

    /**
     * Check user without permission deactivate user
     *
     * @return void
     */
    public function test_check_user_without_permission_deactivate_user()
    {
        $this->loginAsUser();

        $user = User::factory()->create();

        $response = $this->post("/a/users/{$user->id}/deactivate");

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'active' => true
        ]);

        $response->assertStatus(403);
    }

    public function test_check_user_with_permission_reactivate_user()
    {
        $this->loginAsAdmin();

        $user = User::factory()->inactive()->create();

        $response = $this->post("/a/users/{$user->id}/reactivate");

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'active' => true
        ]);

        $response->assertSessionHas(['flash_success' => 'User activating successfully.']);
    }

    public function test_check_user_without_permission_reactivate_user()
    {
        $this->loginAsUser();

        $user = User::factory()->inactive()->create();

        $response = $this->post("/a/users/{$user->id}/reactivate");

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'active' => false
        ]);

        $response->assertStatus(403);
    }
}
