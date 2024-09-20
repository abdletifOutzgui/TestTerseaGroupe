<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\TicketStatus;
use App\Models\{User, Appel};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
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
            'agent_id'    => $agent->id,
            'appel_id'    => Appel::factory()->create()->id,
            'commentaire' => $this->faker->sentence(),
            'status'      => $this->faker->randomElement(TicketStatus::cases())->value
        ];
    }
}
