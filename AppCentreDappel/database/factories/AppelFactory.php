<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appel>
 */
class AppelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $agent = User::factory()->create(['role_id' => 2]);

        return [
            'agent_id'  => $agent->id,
            'client_id' => User::factory()->create()->id,
            'call_time' => $this->faker->dateTimeThisYear(),
            'duration'  => $this->faker->numberBetween(1, 60),
            'subject'   => $this->faker->sentence(),
            'comment'   => $this->faker->sentence()
        ];
    }
}
