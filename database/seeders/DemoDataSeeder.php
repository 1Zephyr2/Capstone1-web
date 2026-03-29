<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use Carbon\Carbon;

class DemoDataSeeder extends Seeder
{
    public function run()
    {
        // Clear existing demo data to avoid duplicates
        Patient::truncate();

        // Create sample pets for grooming system
        $pets = [
            [
                'pet_name' => 'Max',
                'species' => 'Dog',
                'breed' => 'Golden Retriever',
                'color' => 'Golden',
                'birthdate' => '2023-03-15',
                'sex' => 'Neutered Male',
                'owner_name' => 'Maria Santos',
                'owner_contact' => 'maria@email.com',
                'address' => '123 Main Street, Scout Barrio, Baguio City',
            ],
            [
                'pet_name' => 'Bella',
                'species' => 'Cat',
                'breed' => 'Siamese',
                'color' => 'Cream and Brown',
                'birthdate' => '2024-06-20',
                'sex' => 'Female',
                'owner_name' => 'Juan Dela Cruz',
                'owner_contact' => 'juan@email.com',
                'address' => '456 Secondary Road, Scout Barrio, Baguio City',
            ],
            [
                'pet_name' => 'Charlie',
                'species' => 'Dog',
                'breed' => 'Labrador Retriever',
                'color' => 'Black',
                'birthdate' => '2022-11-10',
                'sex' => 'Neutered Male',
                'owner_name' => 'Ana Lopez',
                'owner_contact' => 'ana@email.com',
                'address' => '789 Third Avenue, Scout Barrio, Baguio City',
            ],
            [
                'pet_name' => 'Luna',
                'species' => 'Cat',
                'breed' => 'Persian',
                'color' => 'White',
                'birthdate' => '2025-01-05',
                'sex' => 'Spayed Female',
                'owner_name' => 'Rosa Garcia',
                'owner_contact' => 'rosa@email.com',
                'address' => '321 Upper Road, Scout Barrio, Baguio City',
            ],
            [
                'pet_name' => 'Rocky',
                'species' => 'Dog',
                'breed' => 'German Shepherd',
                'color' => 'Black and Tan',
                'birthdate' => '2021-08-15',
                'sex' => 'Neutered Male',
                'owner_name' => 'Pedro Martinez',
                'owner_contact' => 'pedro@email.com',
                'address' => '654 Lower Road, Scout Barrio, Baguio City',
            ],
            [
                'pet_name' => 'Daisy',
                'species' => 'Rabbit',
                'breed' => 'Holland Lop',
                'color' => 'Brown and White',
                'birthdate' => '2025-10-20',
                'sex' => 'Female',
                'owner_name' => 'Carmen Reyes',
                'owner_contact' => 'carmen@email.com',
                'address' => '987 Hill Street, Scout Barrio, Baguio City',
            ],
        ];

        foreach ($pets as $petData) {
            Patient::create($petData);
        }

        $this->command->info('Demo grooming pets created successfully!');
    }
}

