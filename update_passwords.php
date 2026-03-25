<?php

use Illuminate\Support\Facades\Hash;
use App\Models\User;

// Update admin user password
$admin = User::where('username', 'admin')->first();
if ($admin) {
    $admin->password = Hash::make('password123');
    $admin->save();
    echo "Admin user password updated successfully!\n";
    echo "Username: admin\n";
    echo "Password: password123\n\n";
} else {
    echo "Admin user not found.\n\n";
}

// Update staff user password
$staff = User::where('username', 'staff')->first();
if ($staff) {
    $staff->password = Hash::make('password123');
    $staff->save();
    echo "Staff user password updated successfully!\n";
    echo "Username: staff\n";
    echo "Password: password123\n\n";
} else {
    echo "Staff user not found.\n\n";
}

echo "Done!\n";
