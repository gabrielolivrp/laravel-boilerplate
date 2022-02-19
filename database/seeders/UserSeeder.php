<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\User\UsersTableSeeder;
use Database\Seeders\User\RolesAndPermissionsTableSeeder;
use Database\Seeders\User\UsersRolesTableSeeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesAndPermissionsTableSeeder::class,
            UsersTableSeeder::class,
            UsersRolesTableSeeder::class
        ]);
    }
}
