<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    //protected $model = Employee::class;

    public function definition(): array
    {
        static $userIds = null;

        if ($userIds === null) {
            $userIds = User::pluck('id')->shuffle()->all(); // SELECT id FROM users. use shuffle cuz there are no another random function, we used in deifferent factory
        }

        if (empty($userIds)) {
            throw new \Exception('Not enough users to assign to employees. Each user must be unique.');
        }

        $userId = array_pop($userIds);
        $user = User::find($userId);

        return [
            //'user_id' => array_pop($userIds), // php method, returns the last element and pop this element
            'name' => null, // it is overwritten in fromUser function
            'email' => null, // it is overwritten in fromUser function
            'user_id' => null, // it is overwritten in fromUser function
            //'user_id' => $user->id,
            //'name' => $user->name,
            //'email' => $user->email,
            'phone' => fake()->phoneNumber(),
        ];
    }

    public function fromUser(User $user): Factory
    {
        return $this->state([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
