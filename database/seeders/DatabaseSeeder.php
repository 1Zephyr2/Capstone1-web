<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(['username' => 'admin'], [
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@caresync.local',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::updateOrCreate(['username' => 'staff'], [
            'name' => 'Staff User',
            'username' => 'staff',
            'email' => 'staff@caresync.local',
            'password' => Hash::make('staff123'),
            'role' => 'staff',
        ]);

        // Seed species data first
        $this->call(SpeciesSeeder::class);

        // Seed demo patient data
        $this->call(DemoDataSeeder::class);
    }
}
