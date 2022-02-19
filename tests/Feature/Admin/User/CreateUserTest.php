<?php

namespace Tests\Feature\Admin\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\Feature\Admin\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Events\Admin\User\UserCreated;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User with permission can access the create user page
     *
     * @return void
     */
    public function test_check_user_with_permission_can_access_the_create_user_page()
    {
        $this->loginAsAdmin();

        $response = $this->get('/a/users/create');

        $response->assertStatus(200);
    }

    /**
     * User without permission cannot access the create user page
     *
     * @return void
     */
    public function test_user_without_permission_cannot_access_the_create_user_page()
    {
        $this->loginAsUser();

        $response = $this->get('/a/users/create');

        $response->assertStatus(403);
    }

    /**
     * Validation when creating a new user
     *
     * @return void
     */
    public function test_validation_when_creating_new_user()
    {
        $this->loginAsAdmin();

        $response = $this->post('/a/users');

        $response->assertSessionHasErrors(['name', 'email', 'password']);
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

        $response = $this->post('/a/users', [
            'email' => 'john@example.com',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * User with permission can create a new user
     *
     * @return void
     */
    public function test_user_with_permission_can_create_new_user()
    {
        $this->fakeEvent();

        $this->loginAsAdmin();

        $adminRoleId = Role::whereName(config('boilerplate.auth.role.admin'))->first()->id;

        $response = $this->post('/a/users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'active' => '1',
            'roles' => [
                $adminRoleId,
            ],
            'permissions' => []
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'active' => true,
        ]);

        $this->assertDatabaseHas('model_has_roles', [
            'role_id' => $adminRoleId,
            'model_type' => User::class,
            'model_id' => User::whereEmail('john@example.com')->first()->id,
        ]);

        $response->assertRedirect('/a/users')
            ->assertSessionHas(['flash_success' => __('The user was successfully created.')]);

        Event::assertDispatched(UserCreated::class);
    }

    /**
     * User without permission cannot create a new user
     *
     * @return void
     */
    public function test_user_without_permission_cannot_create_new_user()
    {
        $this->loginAsUser();

        $adminRoleId = Role::whereName(config('boilerplate.auth.role.admin'))->first()->id;

        $response = $this->post('/a/users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'active' => '1',
            'roles' => [
                $adminRoleId,
            ],
            'permissions' => []
        ]);

        $response->assertStatus(403);
    }
}
