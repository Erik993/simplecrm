<?php

namespace Database\Factories;

use App\Models\ClientStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $userIds = null;
        static $statusIds = null;

        if ($userIds === null) {
            $userIds = User::pluck('id')->all(); // SELECT id FROM employees
        }

        if ($statusIds === null) {
            $statusIds = ClientStatus::pluck('id')->all(); // SELECT id FROM clientStatus
        }

        return [
            'user_id' => fake()->randomElement($userIds),
            'client_status_id' => fake()->randomElement($statusIds),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
