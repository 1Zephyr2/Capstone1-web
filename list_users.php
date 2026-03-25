<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$users = \App\Models\User::all(['id', 'name', 'email', 'username', 'role', 'created_at']);

echo "\n========== ALL ACCOUNTS IN SYSTEM ==========\n\n";

if ($users->isEmpty()) {
    echo "No users found in the system.\n";
} else {
    foreach ($users as $user) {
        echo "ID: {$user->id}\n";
        echo "  Name: {$user->name}\n";
        echo "  Email: {$user->email}\n";
        echo "  Username: {$user->username}\n";
        echo "  Role: {$user->role}\n";
        echo "  Created: {$user->created_at}\n";
        echo "\n";
    }
    echo "Total Users: " . $users->count() . "\n";
}

echo "\n===========================================\n\n";
