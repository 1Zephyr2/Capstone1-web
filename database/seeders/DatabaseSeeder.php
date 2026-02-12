<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@caresync.local',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Staff User',
            'username' => 'staff',
            'email' => 'staff@caresync.local',
            'password' => bcrypt('password123'),
            'role' => 'staff',
        ]);

        // Seed demo patient data
        // $this->call(DemoDataSeeder::class);
    }
}
