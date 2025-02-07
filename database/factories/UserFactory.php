<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->firstName() . '@gmail.com',
            // 'profile' => fake()->image(storage_path('app/public/uploads/profile'), 100, 100, 'people', false),
            'password' => Hash::make('123456'), // password
            'phone' => function () {
                $phoneNumber = fake('id_ID')->phoneNumber();
                $phoneNumber = str_replace(['.', '-', ' '], '', $phoneNumber); // Hilangkan . - dan spasi
                $phoneNumber = preg_replace('/^\+62/', '0', $phoneNumber); // Ganti +62 dengan 0
                return preg_replace('/^\(\+62\)/', '0', $phoneNumber); // Ganti (+62) dengan 0
            },
            'role' => 'user',
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ];
    }

    // public function admin()
    // {
    //     return $this->state(function (array $attributes) {
    //         return[
    //             'role' => 'admin'
    //         ];
    //         });
    // }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
// str_replace(['@yahoo.com', '@hotmail.com'], '@gmail.com', fake()->unique()->freeEmail())
