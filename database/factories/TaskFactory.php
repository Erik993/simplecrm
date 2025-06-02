<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Order;
use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
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
        static $employeeIds = null;
        static $taskStatusIds = null;

        if($clientIds == null){
            $clientIds = Client::pluck('id')->all();
        }

        if($orderIds == null){
            $orderIds = Order::pluck('id')->all();
        }

        if($employeeIds == null){
            $employeeIds = Employee::pluck('id')->all();
        }

        if($taskStatusIds == null){
            $taskStatusIds = TaskStatus::pluck('id')->all();
        }

        return [
            'client_id' => fake()->randomElement($clientIds),
            'order_id' => fake()->randomElement($orderIds),
            'employee_id' => fake()->randomElement($employeeIds),
            'task_status_id' => fake()->randomElement($taskStatusIds),
            'title' => fake()->sentence(3),
            'description' => fake()->optional()->paragraph(),
            'due_date' => fake()->dateTimeBetween('now', '+1 month'),
        ];
    }
}
