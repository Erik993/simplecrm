<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $clientIds = null;
        static $orderStatusIds = null;

        if($clientIds == null){
            $clientIds = Client::pluck('id')->all();
        }

        if($orderStatusIds == null){
            $orderStatusIds = OrderStatus::pluck('id')->all();
        }

        return [
            'client_id' => fake()->randomElement($clientIds),
            'order_status_id' => fake()->randomElement($orderStatusIds),
            'title' => fake()->sentence(3),
            'description' => fake()->optional()->paragraph(1),
            'amount' => fake()->randomFloat(2, 50, 1000),
            'finished_at' => fake()->optional()->dateTimeBetween('-1 month', '+1 month'),
        ];
    }
}
