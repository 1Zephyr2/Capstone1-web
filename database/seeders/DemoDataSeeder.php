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
        // Clear existing demo data to avoid duplicates
        Patient::truncate();
        Visit::truncate();
        VitalSign::truncate();
        Immunization::truncate();
        PrenatalRecord::truncate();

        // Create sample patients
        $patients = [
            [
                'first_name' => 'Maria',
                'last_name' => 'Santos',
                'middle_name' => 'Cruz',
                'birthdate' => '1990-05-15',
                'sex' => 'Female',
                'contact_number' => '09171234567',
                'address' => '123 Main Street, Scout Barrio, Baguio City',
                'philhealth_number' => '12-345678901-2',
            ],
            [
                'first_name' => 'Juan',
                'last_name' => 'Dela Cruz',
                'middle_name' => 'Garcia',
                'birthdate' => '1985-08-20',
                'sex' => 'Male',
                'contact_number' => '09181234567',
                'address' => '456 Secondary Road, Scout Barrio, Baguio City',
            ],
            [
                'first_name' => 'Baby',
                'last_name' => 'Reyes',
                'middle_name' => null,
                'birthdate' => '2025-12-01',
                'sex' => 'Female',
                'contact_number' => '09191234567',
                'address' => '789 Third Avenue, Scout Barrio, Baguio City',
            ],
            [
                'first_name' => 'Ana',
                'last_name' => 'Lopez',
                'middle_name' => 'Mendoza',
                'birthdate' => '1995-03-10',
                'sex' => 'Female',
                'contact_number' => '09201234567',
                'address' => '321 Upper Road, Scout Barrio, Baguio City',
                'philhealth_number' => '12-345678902-3',
            ],
            [
                'first_name' => 'Pedro',
                'last_name' => 'Martinez',
                'middle_name' => 'Ramos',
                'birthdate' => '1980-11-25',
                'sex' => 'Male',
                'contact_number' => '09211234567',
                'address' => '654 Lower Road, Scout Barrio, Baguio City',
            ],
            [
                'first_name' => 'Rosa',
                'last_name' => 'Garcia',
                'middle_name' => 'Torres',
                'birthdate' => '1988-07-18',
                'sex' => 'Female',
                'contact_number' => '09221234567',
                'address' => '987 Hill Street, Scout Barrio, Baguio City',
                'philhealth_number' => '12-345678903-4',
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

            // Add immunizations for all patients
            if ($patient->age < 2) {
                // Baby immunizations
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

                Immunization::create([
                    'patient_id' => $patient->id,
                    'vaccine_name' => 'Pentavalent (DPT-HepB-Hib)',
                    'dose_number' => 1,
                    'date_given' => Carbon::parse($patient->birthdate)->addWeeks(6),
                    'administered_by' => 'Nurse Anna',
                ]);
            } elseif ($patient->age >= 2 && $patient->age <= 12) {
                // Child immunizations
                Immunization::create([
                    'patient_id' => $patient->id,
                    'vaccine_name' => 'MMR (Measles, Mumps, Rubella)',
                    'dose_number' => 1,
                    'date_given' => Carbon::now()->subYears(rand(1, 3)),
                    'administered_by' => 'Nurse Anna',
                ]);

                Immunization::create([
                    'patient_id' => $patient->id,
                    'vaccine_name' => 'OPV (Oral Polio Vaccine)',
                    'dose_number' => 3,
                    'date_given' => Carbon::now()->subYears(rand(1, 4)),
                    'administered_by' => 'Nurse Maria',
                ]);
            } elseif ($patient->age >= 13 && $patient->age <= 18) {
                // Teen immunizations
                Immunization::create([
                    'patient_id' => $patient->id,
                    'vaccine_name' => 'HPV (Human Papillomavirus)',
                    'dose_number' => 2,
                    'date_given' => Carbon::now()->subMonths(rand(6, 12)),
                    'administered_by' => 'Nurse Anna',
                ]);

                Immunization::create([
                    'patient_id' => $patient->id,
                    'vaccine_name' => 'Td (Tetanus-Diphtheria)',
                    'dose_number' => 1,
                    'date_given' => Carbon::now()->subMonths(rand(3, 24)),
                    'administered_by' => 'Nurse Maria',
                ]);
            } else {
                // Adult immunizations
                Immunization::create([
                    'patient_id' => $patient->id,
                    'vaccine_name' => 'Influenza',
                    'dose_number' => 1,
                    'date_given' => Carbon::now()->subMonths(rand(1, 6)),
                    'administered_by' => 'Nurse Anna',
                ]);

                if ($patient->age >= 50) {
                    Immunization::create([
                        'patient_id' => $patient->id,
                        'vaccine_name' => 'Pneumococcal',
                        'dose_number' => 1,
                        'date_given' => Carbon::now()->subMonths(rand(3, 12)),
                        'administered_by' => 'Nurse Maria',
                    ]);
                }

                Immunization::create([
                    'patient_id' => $patient->id,
                    'vaccine_name' => 'COVID-19',
                    'dose_number' => 2,
                    'date_given' => Carbon::now()->subMonths(rand(2, 8)),
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
