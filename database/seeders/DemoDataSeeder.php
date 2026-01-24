<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\Visit;
use App\Models\VitalSign;
use App\Models\Immunization;
use App\Models\PrenatalRecord;
use Carbon\Carbon;

class DemoDataSeeder extends Seeder
{
    public function run()
    {
        // Create sample patients
        $patients = [
            [
                'first_name' => 'Maria',
                'last_name' => 'Santos',
                'middle_name' => 'Cruz',
                'birthdate' => '1990-05-15',
                'sex' => 'Female',
                'contact_number' => '09171234567',
                'address' => '123 Main Street, Barangay San Roque, Quezon City',
                'philhealth_number' => '12-345678901-2',
            ],
            [
                'first_name' => 'Juan',
                'last_name' => 'Dela Cruz',
                'middle_name' => 'Garcia',
                'birthdate' => '1985-08-20',
                'sex' => 'Male',
                'contact_number' => '09181234567',
                'address' => '456 Secondary Road, Barangay San Roque, Quezon City',
            ],
            [
                'first_name' => 'Baby',
                'last_name' => 'Reyes',
                'middle_name' => null,
                'birthdate' => '2025-12-01',
                'sex' => 'Female',
                'contact_number' => '09191234567',
                'address' => '789 Third Avenue, Barangay San Roque, Quezon City',
            ],
        ];

        foreach ($patients as $patientData) {
            $patient = Patient::create($patientData);

            // Create a recent visit for each patient
            $visit = Visit::create([
                'patient_id' => $patient->id,
                'service_type' => 'General Checkup',
                'chief_complaint' => 'Routine checkup',
                'health_worker' => 'Nurse Anna',
                'visit_date' => Carbon::now()->subDays(rand(1, 30)),
            ]);

            // Add vital signs
            VitalSign::create([
                'visit_id' => $visit->id,
                'blood_pressure' => '120/80',
                'temperature' => 36.5,
                'pulse_rate' => 75,
                'weight' => 65.5,
                'height' => 165,
            ]);

            // Add immunization for baby
            if ($patient->age < 2) {
                Immunization::create([
                    'patient_id' => $patient->id,
                    'vaccine_name' => 'BCG',
                    'dose_number' => 1,
                    'date_given' => $patient->birthdate,
                    'administered_by' => 'Nurse Anna',
                ]);

                Immunization::create([
                    'patient_id' => $patient->id,
                    'vaccine_name' => 'Hepatitis B',
                    'dose_number' => 1,
                    'date_given' => Carbon::parse($patient->birthdate)->addWeeks(1),
                    'administered_by' => 'Nurse Anna',
                ]);
            }

            // Add prenatal record for female of childbearing age
            if ($patient->sex === 'Female' && $patient->age >= 18 && $patient->age <= 45) {
                PrenatalRecord::create([
                    'patient_id' => $patient->id,
                    'lmp' => Carbon::now()->subWeeks(20),
                    'visit_date' => Carbon::now()->subDays(rand(1, 14)),
                    'weight' => 62.0,
                    'blood_pressure' => '110/70',
                    'fundal_height' => 20.5,
                    'fetal_heart_tone' => '140 bpm',
                ]);
            }
        }

        $this->command->info('Demo data created successfully!');
        $this->command->info('Sample patients:');
        $this->command->info('- Maria Santos (BHC-2026-0001)');
        $this->command->info('- Juan Dela Cruz (BHC-2026-0002)');
        $this->command->info('- Baby Reyes (BHC-2026-0003)');
    }
}
