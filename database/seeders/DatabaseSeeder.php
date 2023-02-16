<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'first_name' => 'Foo',
            'middle_name' => 'D',
            'last_name' => 'Bar',
            'username' => 'kikoadmin',
            'email' => 'kiko@lucky8',
            'user_type_id' => 1,
            'contact' => '111'
        ]);

        \App\Models\User::factory()->create([
            'first_name' => 'Foo',
            'middle_name' => 'D',
            'last_name' => 'Bar',
            'username' => 'samadmin',
            'email' => 'sam@lucky8',
            'user_type_id' => 1,
            'contact' => '222'
        ]);

        \App\Models\User::factory()->create([
            'first_name' => 'admin',
            'middle_name' => 'D',
            'last_name' => 'nistrator',
            'username' => 'admin',
            'email' => 'admin@lucky8',
            'user_type_id' => 1
        ]);

        \App\Models\User::factory()->create([
            'first_name' => 'Foo',
            'middle_name' => 'D',
            'last_name' => 'Bar',
            'username' => 'helpdesk',
            'email' => 'helpdesk@lucky8',
            'user_type_id' => 3,
            'contact' => '333'
        ]);

        $this->call(UserTypeSeeder::class);
    }
}
