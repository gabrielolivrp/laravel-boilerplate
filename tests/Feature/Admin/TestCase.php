<?php

namespace Tests\Feature\Admin;

use Tests\TestCase as BaseTestCase;
use App\Models\User;

class TestCase extends BaseTestCase
{
    /**
     * @return User
     */
    protected function getMasterAdmin(): User
    {
        return User::find(1);
    }

    /**
     * @return User
     */
    protected function loginAsMasterAdmin(): User
    {
        return tap($this->getMasterAdmin(), function($user) {
            $this->actingAs($user);
        });
    }

    /**
     * @return User
     */
    protected function loginAsAdmin(): User
    {
        return $this->login(config('boilerplate.auth.role.admin'));
    }

    /**
     * @return User
     */
    protected function loginAsUser(): User
    {
        return $this->login(null, ['access admin']);
    }
}
