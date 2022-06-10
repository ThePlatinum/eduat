<?php

namespace Database\Factories;

use App\Models\Klass;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'firstname' => $this->faker->firstName(),
      'lastname' => $this->faker->lastName(),
      'othername' => $this->faker->lastName(),
      'email' => $this->faker->unique()->safeEmail(),
      'email_verified_at' => now(),
      'phone' => $this->faker->phoneNumber(),
      'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
      'remember_token' => Str::random(10),
      'gender' => $this->faker->randomElement(['m','f']),
      'dob' => $this->faker->dateTimeBetween('-20 years', '-3 years'),
      'klass_id' => Klass::all()->random()->id
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
