<?php

namespace Database\Factories;

use App\Models\ClientStatus;
use App\Models\Employee;
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
        static $employeeIds = null;
        static $statusIds = null;

        if ($employeeIds === null) {
            $employeeIds = Employee::pluck('id')->all(); // SELECT id FROM employees
        }

        if ($statusIds === null) {
            $statusIds = ClientStatus::pluck('id')->all(); // SELECT id FROM clientStatus
        }

        return [
            'employee_id' => fake()->randomElement($employeeIds),
            'client_status_id' => fake()->randomElement($statusIds),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
