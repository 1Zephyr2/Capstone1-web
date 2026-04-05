<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Patient;
use App\Models\Visit;
use App\Models\VitalSign;

// Get all patients
$patients = Patient::all();

if ($patients->count() === 0) {
    echo "No patients found! Please run the DemoDataSeeder first.\n";
    exit;
}

// Create visits for today
foreach ($patients as $patient) {
    $visit = Visit::create([
        'patient_id' => $patient->id,
        'visit_time' => now()->subHours(rand(1, 8)),
        'service_type' => ['General Checkup', 'Immunization', 'Prenatal'][rand(0, 2)],
        'chief_complaint' => ['Fever and cough', 'Regular checkup', 'Vaccination', 'Follow-up visit'][rand(0, 3)],
        'notes' => 'Patient examined and given appropriate care',
        'health_worker' => 'Nurse Jane Doe'
    ]);

    VitalSign::create([
        'visit_id' => $visit->id,
        'blood_pressure' => (110 + rand(0, 30)) . '/' . (70 + rand(0, 20)),
        'temperature' => 36 + (rand(0, 20) / 10),
        'pulse_rate' => 70 + rand(0, 30),
        'weight' => 50 + rand(0, 40),
        'height' => 150 + rand(0, 30)
    ]);

    echo "✓ Visit created for {$patient->full_name}\n";
}

echo "\nSuccess! All sample visits for today have been created.\n";
