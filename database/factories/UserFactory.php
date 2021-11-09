<?php

namespace Database\Factories;

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
			'name'              => $this->faker->firstName(),
			'email'             => $this->faker->unique()->safeEmail(),
			'email_verified_at' => now(),
			'password'          => '$2a$10$S/ig6emMHit3GQywsDX3R.SX7jcSxqMRAkBLq4jrkRhqOXzV1HKbi', // shokoladi
			'remember_token'    => Str::random(10),
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
