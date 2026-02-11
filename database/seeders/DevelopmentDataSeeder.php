<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Support\Facades\Hash;

class DevelopmentDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test users if they don't exist
        if (!User::where('username', 'admin')->exists()) {
            User::create([
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@caresync.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]);
        }

        if (!User::where('username', 'staff')->exists()) {
            User::create([
                'name' => 'Healthcare Staff',
                'username' => 'staff',
                'email' => 'staff@caresync.com',
                'password' => Hash::make('staff123'),
                'role' => 'staff'
            ]);
        }

        // Create sample patients
        $patients = [
            [
                'first_name' => 'Maria',
                'last_name' => 'Santos',
                'middle_name' => 'Cruz',
                'birthdate' => '1985-06-15',
                'sex' => 'Female',
                'civil_status' => 'Married',
                'address' => '123 Rizal Street, San Jose, Batangas',
                'contact_number' => '09171234567',
                'email' => 'maria.santos@email.com',
                'emergency_contact_name' => 'Juan Santos',
                'emergency_contact_number' => '09181234567'
            ],
            [
                'first_name' => 'Jose',
                'last_name' => 'Dela Cruz',
                'middle_name' => 'Mendoza',
                'birthdate' => '1990-09-20',
                'sex' => 'Male',
                'civil_status' => 'Single',
                'address' => '456 Burgos Avenue, Poblacion, Lipa City',
                'contact_number' => '09267891234',
                'emergency_contact_name' => 'Rosa Dela Cruz',
                'emergency_contact_number' => '09198765432'
            ],
            [
                'first_name' => 'Ana',
                'last_name' => 'Reyes',
                'middle_name' => 'Garcia',
                'birthdate' => '1992-03-08',
                'sex' => 'Female',
                'civil_status' => 'Single',
                'address' => '789 Mabini Street, Bauan, Batangas',
                'contact_number' => '09353456789',
                'email' => 'ana.reyes@email.com',
                'emergency_contact_name' => 'Pedro Reyes',
                'emergency_contact_number' => '09176543210'
            ]
        ];

        foreach ($patients as $patientData) {
            Patient::create($patientData);
        }

        // Create sample appointments
        $patientIds = Patient::pluck('id')->toArray();
        
        if (!empty($patientIds)) {
            $appointments = [
                [
                    'patient_id' => $patientIds[0],
                    'appointment_datetime' => now()->addDays(1),
                    'service_type' => 'General Checkup',
                    'chief_complaint' => 'Regular health checkup',
                    'status' => 'scheduled'
                ],
                [
                    'patient_id' => $patientIds[1],
                    'appointment_datetime' => now()->addDays(3),
                    'service_type' => 'Immunization',
                    'chief_complaint' => 'Flu vaccination',
                    'status' => 'scheduled',
                    'vaccine_type' => 'Influenza',
                    'dose_number' => 1
                ],
                [
                    'patient_id' => $patientIds[2],
                    'appointment_datetime' => now()->addDays(7),
                    'service_type' => 'Prenatal Care',
                    'chief_complaint' => 'Regular prenatal checkup',
                    'status' => 'scheduled',
                    'gestational_age' => 24,
                    'presentation' => 'Vertex'
                ]
            ];

            foreach ($appointments as $appointmentData) {
                Appointment::create($appointmentData);
            }
        }
    }
}
