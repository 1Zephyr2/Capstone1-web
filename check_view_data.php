<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Replicate DashboardController logic
$appointments = \App\Models\Appointment::with('patient')
    ->where('status', '!=', 'cancelled')
    ->get()
    ->groupBy(function($appointment) {
        return $appointment->appointment_date->format('Y-m-d');
    })
    ->map(function($dayAppointments) {
        return $dayAppointments->map(function($appointment) {
            return [
                'id' => $appointment->id,
                'time' => $appointment->formatted_time,
                'patient' => $appointment->patient->full_name,
                'type' => $appointment->service_type,
                'status' => $appointment->status,
                'notes' => $appointment->chief_complaint,
            ];
        })->sortBy('time')->values();
    });

echo "=== APPOINTMENTS DATA SENT TO VIEW ===\n";
echo json_encode($appointments, JSON_PRETTY_PRINT);
echo "\n\n";
echo "=== KEYS (dates) ===\n";
foreach ($appointments->keys() as $key) {
    echo "- $key\n";
}
