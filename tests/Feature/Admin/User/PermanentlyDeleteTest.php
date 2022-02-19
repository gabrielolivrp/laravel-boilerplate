<?php

namespace Tests\Feature\Admin\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Admin\TestCase;
use App\Models\User;

class PermanentlyDeleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User with permission can access the deleted users page
     *
     * @return void
     */
    public function test_check_user_with_permission_can_access_the_deleted_users_page()
    {
        $this->loginAsAdmin();

        $response = $this->get('/a/users/deleted');

        $response->assertStatus(200);
    }

    /**
     * User without permission cannot access the deleted users page
     *
     * @return void
     */
    public function test_user_without_permission_cannot_access_the_deleted_users_page()
    {
        $this->loginAsUser();

        $response = $this->get('/a/users/deleted');

        $response->assertStatus(403);
    }

    /**
     * Check user with permission permanently delete user
     *
     * @return void
     */
    public function test_check_user_with_permission_permanently_delete_user()
    {
        $this->loginAsAdmin();

        $user = User::factory()->deleted()->create();

        $response = $this->delete("/a/users/{$user->id}/permanently-delete");

        $this->assertDatabaseMissing('users', ['id' => $user->id]);

        $response->assertSessionHas(['flash_success' => 'The user was permanently deleted.']);
    }

    /**
     * Check user without permission permanently delete user
     *
     * @return void
     */
    public function test_check_user_without_permission_permanently_delete_user()
    {
        $this->loginAsUser();

        $deteted_at = now();
        $user = User::factory()->create(['deleted_at' => $deteted_at]);

        $response = $this->delete("/a/users/{$user->id}/permanently-delete");

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'deleted_at' => $deteted_at
        ]);

        $response->assertStatus(403);
    }

    /**
     * Check user with permission restore user
     *
     * @return void
     */
    public function test_check_user_with_permission_restore_user()
    {
        $this->loginAsAdmin();

        $user = User::factory()->deleted()->create();

        $response = $this->post("/a/users/{$user->id}/restore");

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'deleted_at' => null
        ]);

        $response->assertSessionHas(['flash_success' => 'The user was successfully restored.']);
    }

    /**
     * Check user without permission restore user
     *
     * @return void
     */
    public function test_check_user_without_permission_restore_user()
    {
        $this->loginAsUser();

        $deteted_at = now();
        $user = User::factory()->create(['deleted_at' => $deteted_at]);

        $response = $this->post("/a/users/{$user->id}/restore");

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'deleted_at' => $deteted_at
        ]);

        $response->assertStatus(403);
    }
}
