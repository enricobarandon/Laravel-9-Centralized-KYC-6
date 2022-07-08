<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserType::create([
            'role' => 'Administrator'
        ]);

        UserType::create([
            'role' => 'Tech'
        ]);

        UserType::create([
            'role' => 'Help Desk'
        ]);

        UserType::create([
            'role' => 'Supervisor'
        ]);

        UserType::create([
            'role' => 'Player'
        ]);
    }
}
