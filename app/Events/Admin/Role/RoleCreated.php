<?php

namespace App\Events\Admin\Role;

use Illuminate\Queue\SerializesModels;

class RoleCreated
{
    use SerializesModels;

    /**
     * User.
     *
     * @var \App\Models\Role $user
     */
    public $role;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Role $role
     * @return void
     */
    public function __construct($role)
    {
        $this->role = $role;
    }
}
