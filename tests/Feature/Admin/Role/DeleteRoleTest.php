<?php

namespace Tests\Feature\Admin\Role;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\Feature\Admin\TestCase;
use App\Models\Role;
use App\Events\Admin\Role\RoleDestroyed;

class DeleteRoleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User with permission can delete role
     *
     * @return void
     */
    public function test_user_with_permission_can_delete_role()
    {
        $this->fakeEvent();

        $this->loginAsAdmin();

        $role = Role::factory()->create();

        $response = $this->delete("/a/roles/{$role->id}");

        $response->assertRedirect('/a/roles')
            ->assertSessionHas(['flash_success' => __('The role was successfully deleted.')]);

        $this->assertDeleted('roles', ['id' => $role->id]);

        Event::assertDispatched(RoleDestroyed::class);
    }

    /**
     * User without permission cannot delete a role
     *
     * @return void
     */
    public function test_user_without_permission_cannot_delete_role()
    {
        $this->loginAsUser();

        $role = Role::factory()->create();

        $response = $this->delete("/a/roles/{$role->id}");

        $this->assertDatabaseHas('roles', ['id' => $role->id]);

        $response->assertStatus(403);
    }
}
