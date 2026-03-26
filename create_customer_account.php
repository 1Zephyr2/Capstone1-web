<?php

$path = 'database/database.sqlite';

if (!file_exists($path)) {
    die("Database not found at: $path\n");
}

try {
    $pdo = new PDO("sqlite:$path");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Hash the password using PHP's password_hash (Laravel's bcrypt equivalent)
    $hashedPassword = password_hash('password123', PASSWORD_BCRYPT, ['cost' => 12]);
    
    // Check if customer already exists
    $check = $pdo->prepare('SELECT id FROM users WHERE email = :email');
    $check->execute([':email' => 'customer@caresync.local']);
    $existing = $check->fetch();
    
    if ($existing) {
        echo "✓ Customer account already exists!\n\n";
    } else {
        // Insert customer account
        $insert = $pdo->prepare('
            INSERT INTO users (name, username, email, phone, password, role, created_at, updated_at)
            VALUES (:name, :username, :email, :phone, :password, :role, :created_at, :updated_at)
        ');
        
        $now = date('Y-m-d H:i:s');
        $insert->execute([
            ':name' => 'John Doe',
            ':username' => 'johndoe',
            ':email' => 'customer@caresync.local',
            ':phone' => '09987654321',
            ':password' => $hashedPassword,
            ':role' => 'customer',
            ':created_at' => $now,
            ':updated_at' => $now,
        ]);
        
        echo "✓ Customer account created successfully!\n\n";
    }
    
    echo str_repeat("=", 60) . "\n";
    echo "LOGIN CREDENTIALS:\n";
    echo str_repeat("=", 60) . "\n";
    echo "Email:    customer@caresync.local\n";
    echo "Password: password123\n";
    echo "Role:     Customer\n";
    echo str_repeat("=", 60) . "\n\n";
    
    // Display all users
    echo "All users in the system:\n";
    echo str_repeat("-", 60) . "\n";
    printf("%-3s | %-20s | %-25s | %-10s\n", "ID", "Name", "Email", "Role");
    echo str_repeat("-", 60) . "\n";
    
    $result = $pdo->query('SELECT id, name, email, role FROM users ORDER BY id');
    $users = $result->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($users as $user) {
        printf("%-3s | %-20s | %-25s | %-10s\n", 
            $user['id'], 
            substr($user['name'], 0, 20),
            substr($user['email'], 0, 25),
            strtoupper($user['role'])
        );
    }
    
    echo str_repeat("-", 60) . "\n";
    echo "Total: " . count($users) . " user(s)\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
