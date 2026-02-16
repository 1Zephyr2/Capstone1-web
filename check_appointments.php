<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Appointment;

try {
    $appointments = Appointment::with('patient')->get();
    
    echo "Total appointments: " . $appointments->count() . "\n\n";
    
    foreach($appointments as $apt) {
        echo "ID: {$apt->id}\n";
        echo "Date: {$apt->appointment_date}\n";
        echo "Time: {$apt->appointment_time}\n";
        echo "Patient: {$apt->patient->full_name}\n";
        echo "Service: {$apt->service_type}\n";
        echo "Status: {$apt->status}\n";
        echo "---\n";
    }
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
