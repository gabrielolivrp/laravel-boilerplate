<?php

namespace Tests\Feature\Admin\Role;

use App\Events\Admin\Role\RoleCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\Feature\Admin\TestCase;
use App\Models\Role;
use App\Models\Permission;

class CreateRoleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User with permission can access the create role page
     *
     * @return void
     */
    public function test_check_user_with_permission_can_access_the_create_role_page()
    {
        $this->loginAsAdmin();

        $response = $this->get('/a/roles/create');

        $response->assertStatus(200);
    }

    /**
     * User without permission cannot access the create role page
     *
     * @return void
     */
    public function test_user_without_permission_cannot_access_the_create_role_page()
    {
        $this->loginAsUser();

        $response = $this->get('/a/roles/create');

        $response->assertStatus(403);
    }

    /**
     * Validation when creating a new role
     *
     * @return void
     */
    public function test_validation_when_creating_new_role()
    {
        $this->loginAsAdmin();

        $response = $this->post('/a/roles');

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function the_name_must_be_unique()
    {
        $this->loginAsAdmin();

        $response = $this->post('/a/roles', ['name' => config('boilerplate.auth.role.admin')]);

        $response->assertSessionHasErrors('name');
    }

    /**
     * User with permission can create a new role
     *
     * @return void
     */
    public function test_user_with_permission_can_create_new_role()
    {
        $this->fakeEvent();

        $this->loginAsAdmin();

        $accessAdminId = Permission::whereName('access admin')->first()->id;

        $response = $this->post('/a/roles', [
            'name' => 'Editor',
            'permissions' => [$accessAdminId]
        ]);

        $this->assertDatabaseHas('roles', [
            'name' => 'Editor',
            'guard_name' => 'web'
        ]);

        $this->assertDatabaseHas('role_has_permissions', [
            'permission_id' => $accessAdminId,
            'role_id' => Role::whereName('Editor')->first()->id,
        ]);

        $response->assertRedirect('/a/roles')
            ->assertSessionHas(['flash_success' => __('The role was successfully created.')]);

        Event::assertDispatched(RoleCreated::class);
    }

    /**
     * User without permission cannot create a new role
     *
     * @return void
     */
    public function test_user_without_permission_cannot_create_role()
    {
        $this->loginAsUser();

        $accessAdminId = Permission::whereName('access admin')->first()->id;

        $response = $this->post('/a/roles', [
            'name' => 'Editor',
            'permissions' => [$accessAdminId]
        ]);

        $response->assertStatus(403);
    }
}
