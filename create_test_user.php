<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

// Update existing user with username or create new one
$user = User::where('email', 'admin@caresync.local')->first();

if ($user) {
    $user->username = 'admin';
    $user->save();
    echo "Existing user updated with username!\n";
} else {
    $user = User::create([
        'name' => 'Admin User',
        'username' => 'admin',
        'email' => 'admin@caresync.local',
        'password' => bcrypt('password123'),
    ]);
    echo "New user created successfully!\n";
}

echo "Username: " . $user->username . "\n";
echo "Password: password123\n";
