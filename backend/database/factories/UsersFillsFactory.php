<?php

namespace Database\Factories;

use App\Models\Charity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UsersFills>
 */
class UsersFillsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "status" => "pending",
            "amount" => rand(1000,2000),
            "user_id" => User::factory(),
            "charity_id" => Charity::first()->id,
        ];
    }
}
