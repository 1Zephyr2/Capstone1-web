<?php

$pdo = new PDO('sqlite:database/database.sqlite');
$result = $pdo->query('SELECT id, name, email, role FROM users ORDER BY id');
$users = $result->fetchAll(PDO::FETCH_ASSOC);

if (empty($users)) {
    echo "No users found in the system.\n";
} else {
    echo "Users in the system:\n";
    echo str_repeat("=", 80) . "\n";
    printf("%-5s | %-20s | %-30s | %-15s\n", "ID", "Name", "Email", "Role");
    echo str_repeat("-", 80) . "\n";
    foreach ($users as $user) {
        printf("%-5s | %-20s | %-30s | %-15s\n", 
            $user['id'], 
            substr($user['name'], 0, 20), 
            substr($user['email'], 0, 30),
            $user['role'] ?? 'null'
        );
    }
    echo str_repeat("=", 80) . "\n";
    echo "\nTotal users: " . count($users) . "\n";
    
    // Check for owner
    $owner = array_filter($users, function($u) { return strtolower($u['role']) === 'owner'; });
    if (empty($owner)) {
        echo "\n⚠️  No 'owner' account found in the system.\n";
    } else {
        echo "\n✓ Owner account found:\n";
        foreach ($owner as $o) {
            echo "  - {$o['name']} ({$o['email']})\n";
        }
    }
}
