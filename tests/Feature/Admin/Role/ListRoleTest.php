<?php

namespace Tests\Feature\Admin\Role;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Admin\TestCase;

class ListRoleTest extends TestCase
{
    /**
     * User with permission can access the list roles page
     *
     * @return void
     */
    public function test_user_with_permission_can_access_the_list_roles_page()
    {
        $this->loginAsAdmin();

        $response = $this->get('/a/roles');

        $response->assertStatus(200);
    }

    /**
     * User without permission cannot access the list roles page
     *
     * @return void
     */
    public function test_user_without_permission_cannot_access_the_list_roles_page()
    {
        $this->loginAsUser();

        $response = $this->get('/a/roles');

        $response->assertStatus(403);
    }
}
