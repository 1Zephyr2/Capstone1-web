<?php

// Check both root and capstone databases
$databases = [
    'root' => 'c:\\Users\\keeia\\OneDrive\\Documents\\Capstone1-web-mayerror\\database\\database.sqlite',
    'capstone' => 'c:\\Users\\keeia\\OneDrive\\Documents\\Capstone1-web-mayerror\\capstone\\database\\database.sqlite'
];

echo "Checking for owner/customer accounts in both repositories:\n";
echo str_repeat("=", 80) . "\n\n";

foreach ($databases as $name => $path) {
    if (!file_exists($path)) {
        echo "[$name] Database not found at: $path\n\n";
        continue;
    }
    
    echo "[$name] Database: $path\n";
    echo str_repeat("-", 80) . "\n";
    
    try {
        $pdo = new PDO("sqlite:$path");
        
        // Check if users table exists
        $tables = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='users'")->fetchAll();
        if (empty($tables)) {
            echo "No 'users' table found.\n\n";
            continue;
        }
        
        // Get all users
        $result = $pdo->query('SELECT id, name, email, role FROM users ORDER BY id');
        $users = $result->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($users)) {
            echo "No users found.\n\n";
        } else {
            printf("%-5s | %-25s | %-30s | %-15s\n", "ID", "Name", "Email", "Role");
            echo str_repeat("-", 80) . "\n";
            foreach ($users as $user) {
                printf("%-5s | %-25s | %-30s | %-15s\n", 
                    $user['id'], 
                    substr($user['name'], 0, 25), 
                    substr($user['email'], 0, 30),
                    strtoupper($user['role'] ?? 'NULL')
                );
            }
            
            // Check for customer/owner accounts
            $customers = array_filter($users, function($u) { 
                return in_array(strtolower($u['role']), ['customer', 'owner']); 
            });
            
            if (!empty($customers)) {
                echo "\n✓ Found " . count($customers) . " customer/owner account(s):\n";
                foreach ($customers as $c) {
                    echo "  - {$c['name']} ({$c['email']}) - Role: {$c['role']}\n";
                }
            } else {
                echo "\n⚠️  No customer/owner accounts found.\n";
            }
        }
    } catch (Exception $e) {
        echo "Error accessing database: " . $e->getMessage() . "\n";
    }
    
    echo "\n";
}

echo str_repeat("=", 80) . "\n";
echo "Summary: Check results above for owner/customer accounts.\n";
