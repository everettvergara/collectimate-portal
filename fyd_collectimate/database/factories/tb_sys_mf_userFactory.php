<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class tb_sys_mf_userFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->name();
        $code = mb_substr($name, 0, 30);
        return [
            'code'  => $code,
            'name' => $name,
            'email' => fake()->unique()->safeEmail(),
            'age'   => fake()->numberBetween(20, 60),
            'is_active' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('Kerberos2014!'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
