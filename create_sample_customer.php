<?php

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Patient;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Create sample customer account
$customer = User::updateOrCreate(
    ['email' => 'owner@example.com'],
    [
        'name' => 'Sarah Johnson',
        'username' => 'sarah.johnson',
        'email' => 'owner@example.com',
        'phone' => '(555) 123-4567',
        'password' => Hash::make('password123'),
        'role' => 'customer',
    ]
);

echo "\n========== SAMPLE CUSTOMER ACCOUNT CREATED ==========\n\n";
echo "Name: {$customer->name}\n";
echo "Email: {$customer->email}\n";
echo "Phone: {$customer->phone}\n";
echo "Password: password123\n";
echo "Role: customer\n\n";

// Create some sample pets for this customer
$pets = [
    [
        'pet_name' => 'Max',
        'species' => 'Dog',
        'breed' => 'Golden Retriever',
        'birthdate' => date('Y-m-d', strtotime('-3 years')),
        'sex' => 'Male',
        'color' => 'Golden',
        'owner_name' => $customer->name,
        'owner_contact' => $customer->phone,
        'address' => '123 Oak Street, Springfield, IL 62701',
    ],
    [
        'pet_name' => 'Whiskers',
        'species' => 'Cat',
        'breed' => 'Siamese',
        'birthdate' => date('Y-m-d', strtotime('-2 years')),
        'sex' => 'Female',
        'color' => 'Cream',
        'owner_name' => $customer->name,
        'owner_contact' => $customer->phone,
        'address' => '123 Oak Street, Springfield, IL 62701',
    ],
];

echo "Creating sample pets:\n\n";

foreach ($pets as $petData) {
    $pet = Patient::create(array_merge($petData, ['user_id' => $customer->id]));
    
    echo "✓ {$pet->pet_name} ({$pet->species} - {$pet->breed})\n";
}

echo "\n====================================================\n\n";
echo "Sample customer account is ready to use!\n";
echo "Login with: owner@example.com / password123\n\n";
