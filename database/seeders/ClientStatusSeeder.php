<?php

namespace Database\Seeders;

use App\Models\ClientStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses =['New', 'Active', 'Inactive', 'Banned'];
        foreach ($statuses as $status){
            ClientStatus::create(['status' => $status]);
        }

        //ClientStatus::create(['status' => 'New']);
        //ClientStatus::create(['status' => 'Active']);
        //ClientStatus::create(['status' => 'Inactive']);
        //ClientStatus::create(['status' => 'Banned']);

    }
}
