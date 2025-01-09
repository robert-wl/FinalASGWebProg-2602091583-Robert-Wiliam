<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
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
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'summary' => $this->faker->paragraph(),
            'linkedin' => $this->faker->url(),
            'mobile' => $this->faker->phoneNumber(),
            'registration_fee' => $this->faker->randomFloat(2, 0, 1000),
            'coins' => $this->faker->numberBetween(0, 1000),
            'visibility' => $this->faker->boolean(),
            'paid' => $this->faker->boolean(),
            'avatar' => $this->faker->imageUrl(200, 200, 'people'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
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
}
