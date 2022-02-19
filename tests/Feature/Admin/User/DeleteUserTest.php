<?php

namespace Tests\Feature\Admin\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\Feature\Admin\TestCase;
use App\Models\User;
use App\Events\Admin\User\UserDestroyed;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User with permission can delete user
     *
     * @return void
     */
    public function test_user_with_permission_can_delete_user()
    {
        $this->fakeEvent();

        $this->loginAsAdmin();

        $user = User::factory()->create();

        $response = $this->delete("/a/users/{$user->id}");

        $response->assertRedirect('/a/users')
            ->assertSessionHas(['flash_success' => __('The user was successfully deleted.')]);

        $this->assertSoftDeleted('users', ['id' => $user->id]);

        Event::assertDispatched(UserDestroyed::class);
    }

    /**
     * User without permission cannot delete a user
     *
     * @return void
     */
    public function test_user_without_permission_cannot_delete_user()
    {
        $this->loginAsUser();

        $user = User::factory()->create();

        $response = $this->delete("/a/users/{$user->id}");

        $response->assertStatus(403);

        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }

    /**
     * User cannot delete himself
     *
     * @return void
     */
    public function test_user_cannot_delete_himself()
    {
        $user = $this->loginAsAdmin();

        $response = $this->delete("/a/users/{$user->id}");

        $response->assertSessionHas(['flash_danger' => __('You can not delete yourself.')]);

        $this->assertDatabaseHas('users', ['id' => $user->id, 'deleted_at' => null]);
    }

    /**
     * The master admin cannot deleted
     *
     * @return void
     */
    public function test_the_master_admin_cannot_deleted()
    {
        $this->loginAsAdmin();

        $admin = $this->getMasterAdmin();

        $response = $this->delete("/a/users/{$admin->id}");

        $response->assertStatus(403);

        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }
}
