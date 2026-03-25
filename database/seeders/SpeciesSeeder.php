<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $species = [
            [
                'name' => 'Dog',
                'characteristics' => json_encode([
                    'Average Age' => '10-13 years',
                    'Size Range' => 'Small to Large',
                    'Diet' => 'Carnivorous/Omnivorous',
                    'Common Breeds' => 'Labrador, German Shepherd, Golden Retriever',
                    'Special Care' => 'Regular exercise, vaccinations, heartworm prevention',
                ]),
                'description' => 'Canine companion animals',
            ],
            [
                'name' => 'Cat',
                'characteristics' => json_encode([
                    'Average Age' => '12-18 years',
                    'Size Range' => 'Small',
                    'Diet' => 'Carnivorous',
                    'Common Breeds' => 'Persian, Siamese, Maine Coon',
                    'Special Care' => 'Indoor enrichment, vaccinations, flea prevention',
                ]),
                'description' => 'Feline companion animals',
            ],
            [
                'name' => 'Rabbit',
                'characteristics' => json_encode([
                    'Average Age' => '8-12 years',
                    'Size Range' => 'Small to Medium',
                    'Diet' => 'Herbivorous',
                    'Common Breeds' => 'Holland Lop, Flemish Giant, Rex',
                    'Special Care' => 'Hay diet, spacious enclosure, dental care',
                ]),
                'description' => 'Small herbivorous mammals',
            ],
            [
                'name' => 'Bird',
                'characteristics' => json_encode([
                    'Average Age' => '5-50 years (varies by species)',
                    'Size Range' => 'Small to Large',
                    'Diet' => 'Seeds, fruits, vegetables',
                    'Common Types' => 'Parrots, Canaries, Budgies',
                    'Special Care' => 'Cage maintenance, socialization, veterinary check-ups',
                ]),
                'description' => 'Avian companion animals',
            ],
            [
                'name' => 'Guinea Pig',
                'characteristics' => json_encode([
                    'Average Age' => '5-7 years',
                    'Size Range' => 'Small',
                    'Diet' => 'Herbivorous, Vitamin C dependent',
                    'Common Varieties' => 'American, Abyssinian, Peruvian',
                    'Special Care' => 'Vitamin C supplements, companionship, spacious housing',
                ]),
                'description' => 'Small rodent companion animals',
            ],
            [
                'name' => 'Hamster',
                'characteristics' => json_encode([
                    'Average Age' => '2-3 years',
                    'Size Range' => 'Very Small',
                    'Diet' => 'Omnivorous',
                    'Common Types' => 'Syrian, Dwarf, Roborovski',
                    'Special Care' => 'Secure cage, exercise wheel, bedding management',
                ]),
                'description' => 'Small rodent pets',
            ],
            [
                'name' => 'Fish',
                'characteristics' => json_encode([
                    'Average Age' => '3-10 years (varies)',
                    'Size Range' => 'Small to Large',
                    'Diet' => 'Omnivorous/Carnivorous',
                    'Common Types' => 'Goldfish, Betta, Tropical fish',
                    'Special Care' => 'Water quality, tank maintenance, proper feeding',
                ]),
                'description' => 'Aquatic companion animals',
            ],
        ];

        foreach ($species as $item) {
            \App\Models\Species::create($item);
        }
    }
}
