<?php

namespace Tests\Feature\Admin\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\Feature\Admin\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Events\Admin\User\UserUpdated;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User with permission can access the edit user page
     *
     * @return void
     */
    public function test_user_with_permission_can_access_the_edit_user_page()
    {
        $this->loginAsAdmin();

        $user = User::factory()->create();

        $response = $this->get("/a/users/{$user->id}/edit");

        $response->assertStatus(200);
    }

    /**
     * User without permission cannot access the edit user page
     *
     * @return void
     */
    public function test_user_without_permission_cannot_access_the_edit_user_page()
    {
        $this->loginAsUser();

        $user = User::factory()->create();

        $response = $this->get("/a/users/{$user->id}/edit");

        $response->assertStatus(403);
    }

    /**
     * Validation when creating a new user
     *
     * @return void
     */
    public function test_validation_when_updating_user()
    {
        $this->loginAsAdmin();

        $user = User::factory()->create();

        $response = $this->put("/a/users/{$user->id}");

        $response->assertSessionHasErrors(['name', 'email']);
    }


    /**
     * User email needs to be unique
     *
     * @return void
     */
    public function test_user_email_needs_to_be_unique()
    {
        $this->loginAsAdmin();

        User::factory()->create(['email' => 'john@example.com']);

        $user = User::factory()->create();

        $response = $this->put("/a/users/{$user->id}", [
            'email' => 'john@example.com',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * User with permission can update user
     *
     * @return void
     */
    public function test_user_with_permission_can_update_user()
    {
        $this->loginAsAdmin();

        $adminRoleId = Role::whereName(config('boilerplate.auth.role.admin'))->first()->id;

        $user = User::factory()->create();

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $response = $this->put("/a/users/{$user->id}", [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'roles' => [
                $adminRoleId,
            ],
        ]);

        $response->assertStatus(302);
    }

    /**
     * User without permission cannot update user
     *
     * @return void
     */
    public function test_user_without_permission_cannot_update_user()
    {
        $this->loginAsUser();

        $adminRoleId = Role::whereName(config('boilerplate.auth.role.admin'))->first()->id;

        $user = User::factory()->create();

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $response = $this->put("/a/users/{$user->id}", [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'roles' => [
                $adminRoleId,
            ],
        ]);

        $response->assertStatus(403);
    }

    /**
     * Update user
     *
     * @return void
     */
    public function test_update_user()
    {
        $this->fakeEvent();

        $this->loginAsAdmin();

        $adminRoleId = Role::whereName(config('boilerplate.auth.role.admin'))->first()->id;

        $user = User::factory()->create();

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $response = $this->put("/a/users/{$user->id}", [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'roles' => [
                $adminRoleId,
            ],
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $this->assertDatabaseHas('model_has_roles', [
            'role_id' => $adminRoleId,
            'model_type' => User::class,
            'model_id' => User::whereEmail('john@example.com')->first()->id,
        ]);

        $response->assertRedirect('/a/users')
            ->assertSessionHas(['flash_success' => __('The user was successfully updated.')]);

        Event::assertDispatched(UserUpdated::class);
    }
}
