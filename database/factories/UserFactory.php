<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Enums\UserRole;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => UserRole::OWNER->value,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * This factory state modifier will be used to seed the database with an admin user at install.
     * The dummy values will be replaced with user input from a form if no `owner` users exist.
     * This should be `user_id` of 1, and can be used to seed a sample Page and Post.
     */
    public function firstInstall(): static
    {
        return $this->state( function( array $attributes )
        {
            return [
                'first_name' => 'Tom',
                'last_name' => 'Anderson',
                'display_name' => 'Myspace Tom',
                'email' => 'tom@myspace.test',
                'password' => static::$password ??= Hash::make('password'),
                'avatar' => 'https://pbs.twimg.com/profile_images/1237550450/mstom_400x400.jpg',
                'role' => UserRole::OWNER->value,
            ];
        });
    }
}
