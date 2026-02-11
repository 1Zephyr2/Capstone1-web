<?php

use Illuminate\Support\Facades\Hash;
use App\Models\User;

// Create admin user
$admin = User::updateOrCreate(
    ['username' => 'admin'],
    [
        'name' => 'System Administrator',
        'email' => 'admin@caresync.local',
        'phone' => '09123456789',
        'password' => Hash::make('admin123'),
        'role' => 'admin',
    ]
);

echo "Admin user created successfully!\n";
echo "Username: admin\n";
echo "Password: admin123\n\n";

// Update existing users to staff role if they don't have a role set
$updated = User::whereNull('role')
    ->orWhere('role', '')
    ->update(['role' => 'staff']);

if ($updated > 0) {
    echo "$updated existing user(s) updated to staff role\n";
}

echo "\nDone!\n";
