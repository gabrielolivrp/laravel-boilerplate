<?php

namespace Database\Seeders\User;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::find(1);
        $admin->assignRole(config('boilerplate.auth.role.admin'));
    }
}
