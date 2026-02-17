<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;
use App\Models\Visit;
use App\Models\Immunization;
use App\Models\BreedingRecord;
use App\Models\VitalSign;
use App\Models\Referral;
use Carbon\Carbon;

class CleanupAndVetDataSeeder extends Seeder
{
    /**
     * Run the database seeds to clean up old data and populate with vet data.
     */
    public function run(): void
    {
        $this->command->info('Cleaning up old human health data...');
        
        // Delete all existing records (supports both MySQL and SQLite)
        $driver = DB::getDriverName();
        
        if ($driver === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        } elseif ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;');
        }
        
        BreedingRecord::truncate();
        VitalSign::truncate();
        Immunization::truncate();
        Referral::truncate();
        Visit::truncate();
        Patient::truncate();
        
        if ($driver === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } elseif ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON;');
        }
        
        $this->command->info('Old data cleaned.');
        $this->command->info('Creating veterinary demo data...');
        
        // Create sample pets
        $pets = [
            [
                'patient_id' => 'PET-2026-001',
                'pet_name' => 'Max',
                'species' => 'Dog',
                'breed' => 'Golden Retriever',
                'color' => 'Golden',
                'birthdate' => '2022-03-15',
                'sex' => 'Male',
                'owner_name' => 'John Johnson',
                'owner_contact' => '09171234567',
                'address' => '123 Pet Street, Manila',
                'microchip_number' => 'MC98765432101',
            ],
            [
                'patient_id' => 'PET-2026-002',
                'pet_name' => 'Bella',
                'species' => 'Cat',
                'breed' => 'Siamese',
                'color' => 'Cream',
                'birthdate' => '2021-07-20',
                'sex' => 'Female',
                'owner_name' => 'Sarah Smith',
                'owner_contact' => '09187654321',
                'address' => '456 Feline Ave, Quezon City',
                'microchip_number' => 'MC98765432102',
            ],
            [
                'patient_id' => 'PET-2026-003',
                'pet_name' => 'Charlie',
                'species' => 'Dog',
                'breed' => 'Labrador Retriever',
                'color' => 'Yellow',
                'birthdate' => '2020-11-10',
                'sex' => 'Neutered Male',
                'owner_name' => 'Michael Brown',
                'owner_contact' => '09191112222',
                'address' => '789 Canine St, Makati',
                'microchip_number' => 'MC98765432103',
            ],
            [
                'patient_id' => 'PET-2026-004',
                'pet_name' => 'Luna',
                'species' => 'Cat',
                'breed' => 'Persian',
                'color' => 'White',
                'birthdate' => '2023-01-05',
                'sex' => 'Spayed Female',
                'owner_name' => 'Maria Garcia',
                'owner_contact' => '09203334444',
                'address' => '321 Whisker Lane, Pasig',
                'microchip_number' => 'MC98765432104',
            ],
            [
                'patient_id' => 'PET-2026-005',
                'pet_name' => 'Rocky',
                'species' => 'Dog',
                'breed' => 'German Shepherd',
                'color' => 'Black and Tan',
                'birthdate' => '2021-05-18',
                'sex' => 'Male',
                'owner_name' => 'Carlos Martinez',
                'owner_contact' => '09215556666',
                'address' => '555 Bark Blvd, Taguig',
                'microchip_number' => 'MC98765432105',
            ],
            [
                'patient_id' => 'PET-2026-006',
                'pet_name' => 'Daisy',
                'species' => 'Rabbit',
                'breed' => 'Holland Lop',
                'color' => 'Brown',
                'birthdate' => '2023-08-22',
                'sex' => 'Female',
                'owner_name' => 'Jennifer Lee',
                'owner_contact' => '09227778888',
                'address' => '888 Bunny Trail, Mandaluyong',
                'microchip_number' => 'MC98765432106',
            ],
        ];

        foreach ($pets as $petData) {
            $pet = Patient::create($petData);
            
            // Create recent wellness exam
            $visit = Visit::create([
                'patient_id' => $pet->id,
                'visit_date' => Carbon::now()->subDays(rand(1, 30)),
                'service_type' => 'Wellness Exam',
                'chief_complaint' => 'Annual wellness checkup',
                'notes' => 'Healthy, all vitals normal. Continue regular diet and exercise. Overall condition excellent.',
            ]);

            // Add vital signs
            VitalSign::create([
                'visit_id' => $visit->id,
                'weight' => $pet->species === 'Dog' ? rand(20, 35) : ($pet->species === 'Cat' ? rand(3, 6) : rand(2, 4)),
                'temperature' => rand(380, 392) / 10,
                'blood_pressure' => rand(70, 120), // Heart rate for pets
                'pulse_rate' => rand(70, 120),
            ]);

            // Add vaccinations based on species
            if ($pet->species === 'Dog') {
                $vaccines = ['Rabies', 'DHPP', 'Bordetella', 'Leptospirosis'];
            } elseif ($pet->species === 'Cat') {
                $vaccines = ['FVRCP', 'Feline Rabies', 'FeLV'];
            } else {
                $vaccines = ['Rabies'];
            }

            foreach ($vaccines as $vaccine) {
                Immunization::create([
                    'patient_id' => $pet->id,
                    'vaccine_name' => $vaccine,
                    'date_given' => Carbon::now()->subMonths(rand(1, 6)),
                    'next_dose_due' => Carbon::now()->addMonths(rand(6, 12)),
                    'administered_by' => 'Dr. Veterinarian',
                ]);
            }

            // Create vaccination visit
            $vacVisit = Visit::create([
                'patient_id' => $pet->id,
                'visit_date' => Carbon::now()->subMonths(rand(1, 3)),
                'service_type' => 'Vaccination',
                'chief_complaint' => 'Scheduled vaccination',
                'notes' => 'Healthy - vaccines administered: ' . implode(', ', array_slice($vaccines, 0, 2)) . '. No adverse reactions observed.',
            ]);
        }

        // Add breeding records for female pets
        $femalePets = Patient::where('sex', 'Female')->whereIn('species', ['Dog', 'Cat'])->get();
        foreach ($femalePets->take(2) as $pet) {
            BreedingRecord::create([
                'patient_id' => $pet->id,
                'checkup_date' => Carbon::now()->subDays(rand(5, 15)),
                'weight' => $pet->species === 'Dog' ? rand(20, 30) : rand(3, 5),
                'breeding_date' => Carbon::now()->subDays(rand(10, 40)),
                'sire' => 'Champion ' . $pet->breed,
                'dam' => $pet->pet_name,
                'heat_cycle_date' => Carbon::now()->subDays(rand(45, 60)),
                'pregnancy_confirmed_date' => Carbon::now()->subDays(rand(5, 25)),
                'expected_delivery_date' => Carbon::now()->addDays(rand(20, 40)),
                'litter_size' => null,
                'breeding_status' => 'Confirmed Pregnant',
                'notes' => 'Normal progression, monitoring closely',
                'risk_factors' => 'None identified',
                'referred' => false,
            ]);

            // Add breeding consultation visit
            Visit::create([
                'patient_id' => $pet->id,
                'visit_date' => Carbon::now()->subDays(rand(5, 15)),
                'service_type' => 'Breeding Consultation',
                'chief_complaint' => 'Pregnancy checkup',
                'notes' => 'Healthy pregnancy progression. Prenatal supplements prescribed. Next checkup in 2 weeks.',
            ]);
        }

        $this->command->info('Veterinary demo data created.');
        $this->command->info('Summary:');
        $this->command->info('   - Pets: ' . Patient::count());
        $this->command->info('   - Visits: ' . Visit::count());
        $this->command->info('   - Vaccinations: ' . Immunization::count());
        $this->command->info('   - Breeding Records: ' . BreedingRecord::count());
        $this->command->info('   - Vital Signs: ' . VitalSign::count());
    }
}
