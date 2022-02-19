<?php

namespace Database\Seeders\User;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            // General permission
            ['name' => 'access admin'],

            // Permissions user
            ['name' => 'view user'],
            ['name' => 'create user'],
            ['name' => 'update user'],
            ['name' => 'delete user'],
            ['name' => 'restore user'],
            ['name' => 'permanently delete user'],
            ['name' => 'change password user'],
            ['name' => 'deactivate user'],
            ['name' => 'reactivate user'],
            ['name' => 'confirm email verification user'],
            ['name' => 'unconfirm email verification user'],
            ['name' => 'resend email verification user'],
            ['name' => 'clear session user'],
            ['name' => 'impersonate user'],

            // Permission role
            ['name' => 'create role'],
            ['name' => 'update role'],
            ['name' => 'delete role'],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'guard_name' => 'web',
                'name' => $permission['name']
            ]);
        }
        // Create roles
        foreach (config('boilerplate.auth.role') as $key => $name) {
            Role::create([
                'guard_name' => 'web',
                'name' => $name,
            ]);
        }

        // Associate permissions with roles
        $admin = Role::findByName(config('boilerplate.auth.role.admin'));

        $admin->givePermissionTo(Permission::all());
    }
}
