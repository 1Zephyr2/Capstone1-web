<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\Visit;
use App\Models\VitalSign;
use App\Models\Immunization;
use App\Models\BreedingRecord;
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
        BreedingRecord::truncate();

        // Create sample animal patients for veterinary clinic
        $patients = [
            [
                'patient_id' => 'VET-2026-0001',
                'pet_name' => 'Max',
                'species' => 'Dog',
                'breed' => 'Golden Retriever',
                'color' => 'Golden',
                'birthdate' => '2023-03-15',
                'sex' => 'Neutered Male',
                'owner_name' => 'Maria Santos',
                'owner_contact' => '09171234567',
                'address' => '123 Main Street, Scout Barrio, Baguio City',
                'microchip_number' => '982000123456789',
                'emergency_contact_name' => 'Juan Santos',
                'emergency_contact_number' => '09181234567',
            ],
            [
                'patient_id' => 'VET-2026-0002',
                'pet_name' => 'Bella',
                'species' => 'Cat',
                'breed' => 'Siamese',
                'color' => 'Cream and Brown',
                'birthdate' => '2024-06-20',
                'sex' => 'Female',
                'owner_name' => 'Juan Dela Cruz',
                'owner_contact' => '09187654321',
                'address' => '456 Secondary Road, Scout Barrio, Baguio City',
                'microchip_number' => '982000987654321',
            ],
            [
                'patient_id' => 'VET-2026-0003',
                'pet_name' => 'Charlie',
                'species' => 'Dog',
                'breed' => 'Labrador Retriever',
                'color' => 'Black',
                'birthdate' => '2022-11-10',
                'sex' => 'Male',
                'owner_name' => 'Ana Lopez',
                'owner_contact' => '09191234567',
                'address' => '789 Third Avenue, Scout Barrio, Baguio City',
                'microchip_number' => '982000555666777',
                'emergency_contact_name' => 'Pedro Lopez',
                'emergency_contact_number' => '09201234567',
            ],
            [
                'patient_id' => 'VET-2026-0004',
                'pet_name' => 'Luna',
                'species' => 'Cat',
                'breed' => 'Persian',
                'color' => 'White',
                'birthdate' => '2025-01-05',
                'sex' => 'Spayed Female',
                'owner_name' => 'Rosa Garcia',
                'owner_contact' => '09221234567',
                'address' => '321 Upper Road, Scout Barrio, Baguio City',
            ],
            [
                'patient_id' => 'VET-2026-0005',
                'pet_name' => 'Rocky',
                'species' => 'Dog',
                'breed' => 'German Shepherd',
                'color' => 'Black and Tan',
                'birthdate' => '2021-08-15',
                'sex' => 'Male',
                'owner_name' => 'Pedro Martinez',
                'owner_contact' => '09211234567',
                'address' => '654 Lower Road, Scout Barrio, Baguio City',
                'microchip_number' => '982000111222333',
            ],
            [
                'patient_id' => 'VET-2026-0006',
                'pet_name' => 'Daisy',
                'species' => 'Rabbit',
                'breed' => 'Holland Lop',
                'color' => 'Brown and White',
                'birthdate' => '2025-10-20',
                'sex' => 'Female',
                'owner_name' => 'Carmen Reyes',
                'owner_contact' => '09231234567',
                'address' => '987 Hill Street, Scout Barrio, Baguio City',
            ],
        ];

        foreach ($patients as $patientData) {
            $patient = Patient::create($patientData);

            // Create a recent wellness visit for each patient
            $visit = Visit::create([
                'patient_id' => $patient->id,
                'service_type' => 'Wellness Exam',
                'chief_complaint' => 'Annual checkup',
                'health_worker' => 'Dr. Veterinarian Anna',
                'visit_date' => Carbon::now()->subDays(rand(1, 30)),
            ]);

            // Add vital signs appropriate for the species
            if ($patient->species === 'Dog') {
                VitalSign::create([
                    'visit_id' => $visit->id,
                    'temperature' => rand(380, 392) / 10, // 38.0-39.2°C normal for dogs
                    'pulse_rate' => rand(60, 140),
                    'respiratory_rate' => rand(10, 30),
                    'weight' => rand(25, 35),
                ]);
            } elseif ($patient->species === 'Cat') {
                VitalSign::create([
                    'visit_id' => $visit->id,
                    'temperature' => rand(380, 392) / 10, // 38.0-39.2°C normal for cats
                    'pulse_rate' => rand(140, 220),
                    'respiratory_rate' => rand(20, 30),
                    'weight' => rand(3, 6),
                ]);
            } else { // Rabbit
                VitalSign::create([
                    'visit_id' => $visit->id,
                    'temperature' => rand(385, 400) / 10, // 38.5-40.0°C normal for rabbits
                    'pulse_rate' => rand(130, 325),
                    'respiratory_rate' => rand(30, 60),
                    'weight' => rand(1, 3),
                ]);
            }

            // Add species-appropriate vaccinations
            if ($patient->species === 'Dog') {
                // Core dog vaccines
                Immunization::create([
                    'patient_id' => $patient->id,
                    'vaccine_name' => 'Rabies',
                    'dose_number' => 1,
                    'date_given' => Carbon::parse($patient->birthdate)->addMonths(4),
                    'next_dose_due' => Carbon::parse($patient->birthdate)->addMonths(16),
                    'administered_by' => 'Dr. Veterinarian Anna',
                ]);

                Immunization::create([
                    'patient_id' => $patient->id,
                    'vaccine_name' => 'DHPP (Distemper, Hepatitis, Parvovirus, Parainfluenza)',
                    'dose_number' => 3,
                    'date_given' => Carbon::parse($patient->birthdate)->addMonths(4),
                    'next_dose_due' => Carbon::parse($patient->birthdate)->addYears(1),
                    'administered_by' => 'Dr. Veterinarian Anna',
                ]);

                Immunization::create([
                    'patient_id' => $patient->id,
                    'vaccine_name' => 'Bordetella',
                    'dose_number' => 1,
                    'date_given' => Carbon::parse($patient->birthdate)->addMonths(6),
                    'administered_by' => 'Dr. Veterinarian Maria',
                ]);
            } elseif ($patient->species === 'Cat') {
                // Core cat vaccines
                Immunization::create([
                    'patient_id' => $patient->id,
                    'vaccine_name' => 'Rabies',
                    'dose_number' => 1,
                    'date_given' => Carbon::parse($patient->birthdate)->addMonths(4),
                    'next_dose_due' => Carbon::parse($patient->birthdate)->addMonths(16),
                    'administered_by' => 'Dr. Veterinarian Anna',
                ]);

                Immunization::create([
                    'patient_id' => $patient->id,
                    'vaccine_name' => 'FVRCP (Feline Viral Rhinotracheitis, Calicivirus, Panleukopenia)',
                    'dose_number' => 3,
                    'date_given' => Carbon::parse($patient->birthdate)->addMonths(4),
                    'next_dose_due' => Carbon::parse($patient->birthdate)->addYears(1),
                    'administered_by' => 'Dr. Veterinarian Anna',
                ]);

                Immunization::create([
                    'patient_id' => $patient->id,
                    'vaccine_name' => 'FeLV (Feline Leukemia)',
                    'dose_number' => 2,
                    'date_given' => Carbon::parse($patient->birthdate)->addMonths(5),
                    'administered_by' => 'Dr. Veterinarian Maria',
                ]);
            }

            // Add breeding record for intact female animals
            if (($patient->species === 'Dog' || $patient->species === 'Cat') && 
                $patient->sex === 'Female' && 
                $patient->age >= 1 && 
                $patient->age <= 7) {
                BreedingRecord::create([
                    'patient_id' => $patient->id,
                    'breeding_date' => Carbon::now()->subDays(45),
                    'sire' => ($patient->species === 'Dog' ? 'Duke (Golden Retriever)' : 'Oliver (Siamese)'),
                    'dam' => $patient->pet_name,
                    'heat_cycle_date' => Carbon::now()->subDays(50),
                    'pregnancy_confirmed_date' => Carbon::now()->subDays(30),
                    'expected_delivery_date' => Carbon::now()->addDays(18),
                    'breeding_status' => 'Confirmed Pregnant',
                    'checkup_date' => Carbon::now()->subDays(7),
                    'weight' => ($patient->species === 'Dog' ? 28.5 : 4.2),
                    'notes' => 'Regular checkup, pregnancy progressing normally.',
                ]);
            }
        }

        $this->command->info('Veterinary demo data created successfully!');
        $this->command->info('Sample pets:');
        $this->command->info('- Max (Dog, Golden Retriever) - VET-2026-0001');
        $this->command->info('- Bella (Cat, Siamese) - VET-2026-0002');
        $this->command->info('- Charlie (Dog, Labrador) - VET-2026-0003');
        $this->command->info('- Luna (Cat, Persian) - VET-2026-0004');
        $this->command->info('- Rocky (Dog, German Shepherd) - VET-2026-0005');
        $this->command->info('- Daisy (Rabbit, Holland Lop) - VET-2026-0006');
    }
}


