<?php

namespace Tests\Feature\Admin\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\Feature\Admin\TestCase;
use App\Models\User;

class ChangeUserPasswordTest extends TestCase
{

    use RefreshDatabase;

    /**
     * User with permission can access the change password user page
     *
     * @return void
     */
    public function test_check_user_with_permission_can_access_the_change_password_user_page()
    {
        $this->loginAsAdmin();

        $user = User::factory()->create();

        $response = $this->get("/a/users/{$user->id}/password/change");

        $response->assertStatus(200);
    }

    /**
     * User without permission cannot access the change password user page
     *
     * @return void
     */
    public function test_user_without_permission_cannot_access_the_change_password_user_page()
    {
        $this->loginAsUser();

        $user = User::factory()->create();

        $response = $this->get("/a/users/{$user->id}/password/change");

        $response->assertStatus(403);
    }

    /**
     * Check that the master administrator cannot be updated
     *
     * @return void
     */
    public function test_check_that_the_master_admin_cannot_be_updated()
    {
        $this->loginAsAdmin();

        $admin = $this->getMasterAdmin();

        $response = $this->get("/a/users/{$admin->id}/password/change");

        $response->assertStatus(403);
    }

    /**
     * Validation when updating password
     *
     * @return void
     */
    public function test_validation_when_updating_password()
    {
        $this->loginAsAdmin();

        $user = User::factory()->create();

        $response = $this->put("/a/users/{$user->id}/password/change/update");

        $response->assertSessionHasErrors('password');
    }

    /**
     * The password must match
     *
     * @return void
     */
    public function test_passwords_must_match()
    {
        $this->loginAsAdmin();

        $user = User::factory()->create();

        $response = $this->put("/a/users/{$user->id}/password/change/update", [
            'password' => 'password1',
            'password_confirmation' => 'password0'
        ]);

        $response->assertSessionHasErrors('password');
    }

    /**
     * The user with permission can update another user's password
     *
     * @retuen void
     */
    public function test_user_with_permission_can_update_another_user_password()
    {
        $this->loginAsAdmin();

        $user = User::factory()->create();

        $response = $this->put("/a/users/{$user->id}/password/change/update", [
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        $response->assertSessionHas('flash_success', __('The user\'s password was successfully updated.'));

        $this->assertTrue(Hash::check('password123', $user->fresh()->password));
    }

    /**
     * The user without permission cannot update another user's password
     *
     * @retuen void
     */
    public function test_user_without_permission_cannot_update_another_user_password()
    {
        $this->loginAsUser();

        $user = User::factory()->create();

        $response = $this->put("/a/users/{$user->id}/password/change/update", [
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        $response->assertStatus(403);
    }

    /**
     * The user with permission cannot update master admin password
     *
     * @retuen void
     */
    public function test_user_with_permission_cannot_update_master_admin_password()
    {
        $this->loginAsAdmin();

        $admin = $this->getMasterAdmin();

        $response = $this->put("/a/users/{$admin->id}/password/change/update", [
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        $response->assertStatus(403);
    }
}
