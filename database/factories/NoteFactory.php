<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $clientIds = null;
        static $orderIds = null;

        if($clientIds == null){
            $clientIds = Client::pluck('id')->all();
        }

        if($orderIds == null){
            $orderIds = Order::pluck('id')->all();
        }

        return [
            'client_id' => fake()->randomElement($clientIds),
            'order_id' => fake()->randomElement($orderIds),
            'content' => fake()-> paragraph(),
        ];
    }
}
