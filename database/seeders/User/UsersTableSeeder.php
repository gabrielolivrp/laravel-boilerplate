<?php

namespace Database\Seeders\User;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'email' => 'admin@boilerplate.com'
        ]);

        if (app()->environment(['local', 'testing'])) {
            User::factory()->create([
                'email' => 'user@boilerplate.com'
            ]);
        }

        User::factory(10)->create();
    }
}
