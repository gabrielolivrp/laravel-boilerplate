<?php

namespace Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Event;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    /**
     * @return void
     */
    protected function fakeEvent()
    {
        $initialDispatcher = Event::getFacadeRoot();
        Event::fake();
        Model::setEventDispatcher($initialDispatcher);
    }

    /**
     * @param string|null $role
     * @param array|null $permissions
     * @return User
     */
    protected function login(?string $role = null, ?array $permissions = null): User
    {
        return tap(User::factory()->create(), function($user) use ($role, $permissions) {
            if ($role) {
                $user->assignRole($role);
            }

            if ($permissions) {
                $user->syncPermissions($permissions);
            }

            $this->actingAs($user);
        });
    }

    /**
     * @return void
     */
    protected function logout()
    {
        auth()->logout();
    }
}
