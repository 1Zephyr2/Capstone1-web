<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$appointments = \App\Models\Appointment::with('patient')->get();

echo "=== APPOINTMENTS IN DATABASE ===\n";
echo "Total: " . $appointments->count() . "\n\n";

foreach ($appointments as $apt) {
    $patient = $apt->patient;
    echo "ID: {$apt->id}\n";
    echo "Patient: {$patient->first_name} {$patient->middle_name} {$patient->last_name}\n";
    echo "Date: {$apt->appointment_date}\n";
    echo "Time: {$apt->appointment_time}\n";
    echo "Type: {$apt->appointment_type}\n";
    echo "Status: {$apt->status}\n";
    echo "---\n";
}
