<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;
use App\Models\Visit;
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
        }

        $this->command->info('Veterinary demo data created.');
        $this->command->info('Summary:');
        $this->command->info('   - Pets: ' . Patient::count());
        $this->command->info('   - Visits: ' . Visit::count());
    }
}
