<?php

namespace App\Events\Admin\User;

use Illuminate\Queue\SerializesModels;

class UserDestroyed
{
    use SerializesModels;

    /**
     * User.
     *
     * @var \App\Models\User $user
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\User $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}
