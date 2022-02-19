<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var User
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * @return UserFactory
     */
    public function active(): UserFactory
    {
        return $this->state(fn () => [
            'active' => true,
        ]);
    }

    /**
     * @return UserFactory
     */
    public function inactive(): UserFactory
    {
        return $this->state(fn () => [
            'active' => false,
        ]);
    }

    /**
     * @return UserFactory
     */
    public function confirmed(): UserFactory
    {
        return $this->state(fn () => [
            'email_verified_at' => now(),
        ]);
    }

    /**
     * @return UserFactory
     */
    public function unconfirmed(): UserFactory
    {
        return $this->state(fn () => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * @return UserFactory
     */
    public function deleted(): UserFactory
    {
        return $this->state(fn () => [
            'deleted_at' => now(),
        ]);
    }
}
