<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

try {
    $patient = Patient::create([
        'first_name' => 'Carlos',
        'middle_name' => 'D.',
        'last_name' => 'Lopez',
        'birthdate' => '1995-08-15',
        'sex' => 'Male',
        'civil_status' => 'Single',
        'contact_number' => '09123456789',
        'address' => '123 Main Street, Barangay San Juan, City',
        'emergency_contact_name' => 'Elena Lopez',
        'emergency_contact_number' => '09234567890',
        'philhealth_number' => 'PH-' . rand(100000000000, 999999999999),
    ]);

    echo "Successfully created patient:\n";
    echo "Patient ID: {$patient->patient_id}\n";
    echo "Name: {$patient->full_name}\n";
    echo "Age: {$patient->age} years\n";
    echo "Sex: {$patient->sex}\n";
    echo "Contact: {$patient->contact_number}\n";
    
} catch (\Exception $e) {
    echo "Error creating patient: " . $e->getMessage() . "\n";
    exit(1);
}
