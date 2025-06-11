<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Note;
use App\Models\Order;
use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            ClientStatusSeeder::class,
            OrderStatusSeeder::class,
            TaskStatusSeeder::class,
        ]);
/*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'login' => 'testLogin',
            'password' => bcrypt('12345'),
            'role' => 'user',
        ]);
*/

/*
        //user count should be = employee count
        User::factory(5)->create()->each(function ($user) {
            //Employee::factory()->fromUser($user)->create();
        });*/

        User::factory(5)->create();
        Client::factory(10)->create();
        Order::factory(100)->create();
        Task::factory(100)->create();
        Note::factory(40)->create();
    }
}
