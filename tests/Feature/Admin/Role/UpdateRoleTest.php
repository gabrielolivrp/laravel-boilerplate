<?php

namespace Tests\Feature\Admin\Role;

use App\Events\Admin\Role\RoleUpdated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\Feature\Admin\TestCase;
use App\Models\Role;
use App\Models\Permission;

class UpdateRoleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User with permission can access the update role page
     *
     * @return void
     */
    public function test_check_user_with_permission_can_access_the_update_role_page()
    {
        $this->loginAsAdmin();

        $role = Role::factory()->create();

        $response = $this->get("/a/roles/{$role->id}/edit");

        $response->assertStatus(200);
    }

    /**
     * User without permission cannot access the update role page
     *
     * @return void
     */
    public function test_user_without_permission_cannot_access_the_update_role_page()
    {
        $this->loginAsUser();

        $role = Role::factory()->create();

        $response = $this->get("/a/roles/{$role->id}/edit");

        $response->assertStatus(403);
    }

    /**
     * Validation when updating a new role
     *
     * @return void
     */
    public function test_validation_when_creating_new_role()
    {
        $this->loginAsAdmin();

        $role = Role::factory()->create();

        $response = $this->put("/a/roles/{$role->id}");

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function the_name_must_be_unique()
    {
        $this->loginAsAdmin();

        $role = Role::factory()->create();

        $response = $this->put("/a/roles/{$role->id}", ['name' => config('boilerplate.auth.role.admin')]);

        $response->assertSessionHasErrors('name');
    }

    /**
     * User with permission can update a new role
     *
     * @return void
     */
    public function test_user_with_permission_can_update_new_role()
    {
        $this->fakeEvent();

        $this->loginAsAdmin();

        $accessAdminId = Permission::whereName('access admin')->first()->id;

        $role = Role::factory()->create([
            'name' => 'Editor'
        ]);

        $response = $this->put("/a/roles/{$role->id}", [
            'name' => 'Editor 2',
            'permissions' => [$accessAdminId]
        ]);

        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'name' => 'Editor 2',
        ]);

        $this->assertDatabaseHas('role_has_permissions', [
            'permission_id' => $accessAdminId,
            'role_id' => $role->id,
        ]);

        $response->assertRedirect('/a/roles')
            ->assertSessionHas(['flash_success' => __('The role was successfully updated.')]);

        Event::assertDispatched(RoleUpdated::class);
    }

    /**
     * User without permission cannot update a new role
     *
     * @return void
     */
    public function test_user_without_permission_cannot_update_new_role()
    {
        $this->loginAsUser();

        $accessAdminId = Permission::whereName('access admin')->first()->id;

        $role = Role::factory()->create();

        $response = $this->put("/a/roles/{$role->id}", [
            'name' => 'Editor',
            'permissions' => [$accessAdminId]
        ]);

        $response->assertStatus(403);
    }
}
