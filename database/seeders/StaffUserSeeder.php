<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class StaffUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if staff user already exists
        $staffExists = User::where('username', 'staff')->exists();

        if (!$staffExists) {
            User::create([
                'name' => 'Staff User',
                'username' => 'staff',
                'email' => 'staff@healthcenter.com',
                'phone' => '09123456789',
                'password' => Hash::make('staff123'),
                'role' => 'staff',
            ]);

            $this->command->info('Staff user created successfully!');
            $this->command->info('Username: staff');
            $this->command->info('Password: staff123');
        } else {
            $this->command->info('Staff user already exists.');
        }
    }
}
