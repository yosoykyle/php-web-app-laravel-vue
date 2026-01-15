<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * =================================================================================================
 *  UserFactory (The "Fake ID Printer")
 * =================================================================================================
 * 
 *  ANALOGY:
 *  Think of this as a machine that prints fake IDs for testing.
 *  Instead of you thinking up random names like "John Doe 1", "John Doe 2"...
 *  this factory generates realistic-looking fake data (names, emails, dates) automatically.
 */
class UserFactory extends Factory
{
    /**
     *  Define the model's default state.
     * 
     *  ANALOGY:
     *  "Here is the template for a standard fake user."
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'faker': A library that generates random fake data.
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(), // Right now.
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password (it's always 'password')
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
