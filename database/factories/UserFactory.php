<?php

// Namespace declaration for the Database and Factories
namespace Database\Factories;

// Import necessary classes and functions from Illuminate\Database\Eloquent\Factories and Illuminate\Support namespaces
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 * 
 * This line indicates that this class extends the Factory class and will be used to create instances of the User model.
 */
class UserFactory extends Factory
{
    // Static property to store the password
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * 
     * This method returns an array of attribute values that will be used to create a new User instance.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(), // Generate a random user name using the `faker` library
            'email' => fake()->unique()->safeEmail(), // Generate a random and unique email address using the `faker` library
            'email_verified_at' => now(), // Set the email verification timestamp to the current time
            'password' => static::$password ??= Hash::make('password'), // Set the user's password to 'password' and hash it using Laravel's built-in `Hash` facade
            'remember_token' => Str::random(10), // Generate a random string to be used as the user's remember token
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        // Set the email verification timestamp to null to indicate that the email address is not verified
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

