<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class FurcareSeeder extends Seeder
{
    public function run(): void
{
    // Clear existing data in correct order (foreign keys)
    DB::table('pet_health_records')->delete();
    DB::table('appointment_requests')->delete();
    DB::table('appointments')->delete();
    DB::table('visits')->delete();
    DB::table('patients')->delete();
    DB::table('users')->delete();

    // ================================================================
    // USERS
    // ================================================================
    $users = [
            // Super Admin
            [
                'name'       => 'Super Admin',
                'username'   => 'superadmin',
                'email'      => 'superadmin@furcare.com',
                'password'   => Hash::make('password123'),
                'role'       => 'super_admin',
                'phone'      => '09171000001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Admin
            [
                'name'       => 'Dr. Maria Santos',
                'username'   => 'drsantos',
                'email'      => 'admin@furcare.com',
                'password'   => Hash::make('password123'),
                'role'       => 'admin',
                'phone'      => '09171000002',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Staff
            [
                'name'       => 'Juan Dela Cruz',
                'username'   => 'jdelacruz',
                'email'      => 'staff@furcare.com',
                'password'   => Hash::make('password123'),
                'role'       => 'staff',
                'phone'      => '09171000003',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Ana Reyes',
                'username'   => 'areyes',
                'email'      => 'staff2@furcare.com',
                'password'   => Hash::make('password123'),
                'role'       => 'staff',
                'phone'      => '09171000004',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Customers
            [
                'name'       => 'Sarah Johnson',
                'username'   => 'sjohnson',
                'email'      => 'customer1@furcare.com',
                'password'   => Hash::make('password123'),
                'role'       => 'customer',
                'phone'      => '09987654321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Miguel Torres',
                'username'   => 'mtorres',
                'email'      => 'customer2@furcare.com',
                'password'   => Hash::make('password123'),
                'role'       => 'customer',
                'phone'      => '09981234567',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Patricia Lim',
                'username'   => 'plim',
                'email'      => 'customer3@furcare.com',
                'password'   => Hash::make('password123'),
                'role'       => 'customer',
                'phone'      => '09991112222',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);

        $superAdminId = DB::table('users')->where('username', 'superadmin')->value('id');
        $adminId      = DB::table('users')->where('username', 'drsantos')->value('id');
        $staffId      = DB::table('users')->where('username', 'jdelacruz')->value('id');
        $staff2Id     = DB::table('users')->where('username', 'areyes')->value('id');
        $customer1Id  = DB::table('users')->where('username', 'sjohnson')->value('id');
        $customer2Id  = DB::table('users')->where('username', 'mtorres')->value('id');
        $customer3Id  = DB::table('users')->where('username', 'plim')->value('id');

        // ================================================================
        // SPECIES
        // ================================================================
        $existingSpecies = DB::table('species')->pluck('id', 'name');

        if (!isset($existingSpecies['Dog'])) {
            DB::table('species')->insert(['name' => 'Dog', 'created_at' => now(), 'updated_at' => now()]);
        }
        if (!isset($existingSpecies['Cat'])) {
            DB::table('species')->insert(['name' => 'Cat', 'created_at' => now(), 'updated_at' => now()]);
        }
        if (!isset($existingSpecies['Rabbit'])) {
            DB::table('species')->insert(['name' => 'Rabbit', 'created_at' => now(), 'updated_at' => now()]);
        }
        if (!isset($existingSpecies['Bird'])) {
            DB::table('species')->insert(['name' => 'Bird', 'created_at' => now(), 'updated_at' => now()]);
        }

        $dogId    = DB::table('species')->where('name', 'Dog')->value('id');
        $catId    = DB::table('species')->where('name', 'Cat')->value('id');
        $rabbitId = DB::table('species')->where('name', 'Rabbit')->value('id');
        $birdId   = DB::table('species')->where('name', 'Bird')->value('id');

        // ================================================================
        // SERVICES
        // ================================================================
        $services = [
            ['name' => 'Bath & Dry',             'category' => 'Grooming Services', 'is_active' => true, 'sort_order' => 1],
            ['name' => 'Full Grooming',           'category' => 'Grooming Services', 'is_active' => true, 'sort_order' => 2],
            ['name' => 'Haircut & Styling',       'category' => 'Grooming Services', 'is_active' => true, 'sort_order' => 3],
            ['name' => 'Nail Trimming',           'category' => 'Grooming Services', 'is_active' => true, 'sort_order' => 4],
            ['name' => 'Ear Cleaning',            'category' => 'Grooming Services', 'is_active' => true, 'sort_order' => 5],
            ['name' => 'Teeth Brushing',          'category' => 'Grooming Services', 'is_active' => true, 'sort_order' => 6],
            ['name' => 'De-shedding Treatment',   'category' => 'Grooming Services', 'is_active' => true, 'sort_order' => 7],
            ['name' => 'Flea & Tick Treatment',   'category' => 'Grooming Services', 'is_active' => true, 'sort_order' => 8],
            ['name' => 'Paw Treatment',           'category' => 'Grooming Services', 'is_active' => true, 'sort_order' => 9],
            ['name' => 'Boarding Checkup',        'category' => 'Other Services',    'is_active' => true, 'sort_order' => 10],
            ['name' => 'Follow-up',               'category' => 'Other Services',    'is_active' => true, 'sort_order' => 11],
        ];

        foreach ($services as $service) {
            $exists = DB::table('services')->where('name', $service['name'])->exists();
            if (!$exists) {
                DB::table('services')->insert(array_merge($service, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }
        }

        // ================================================================
        // PATIENTS (PETS)
        // ================================================================
        $patients = [
            // Customer 1 - Sarah Johnson
            [
                'user_id'       => $customer1Id,
                'patient_id'    => 'VET-2025-0001',
                'pet_name'      => 'Lucky',
                'species'       => 'Dog',
                'species_id'    => $dogId,
                'breed'         => 'Golden Retriever',
                'color'         => 'Golden',
                'birthdate'     => '2022-03-15',
                'sex'           => 'Male',
                'owner_name'    => 'Sarah Johnson',
                'owner_contact' => '09987654321',
                'address'       => '123 Magsaysay Ave, Baguio City',
                'privacy_consent' => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => $customer1Id,
                'patient_id'    => 'VET-2025-0002',
                'pet_name'      => 'Misty',
                'species'       => 'Cat',
                'species_id'    => $catId,
                'breed'         => 'Persian',
                'color'         => 'White',
                'birthdate'     => '2021-07-20',
                'sex'           => 'Female',
                'owner_name'    => 'Sarah Johnson',
                'owner_contact' => '09987654321',
                'address'       => '123 Magsaysay Ave, Baguio City',
                'privacy_consent' => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            // Customer 2 - Miguel Torres
            [
                'user_id'       => $customer2Id,
                'patient_id'    => 'VET-2025-0003',
                'pet_name'      => 'Rex',
                'species'       => 'Dog',
                'species_id'    => $dogId,
                'breed'         => 'German Shepherd',
                'color'         => 'Black & Tan',
                'birthdate'     => '2020-11-05',
                'sex'           => 'Male',
                'owner_name'    => 'Miguel Torres',
                'owner_contact' => '09981234567',
                'address'       => '456 Session Road, Baguio City',
                'privacy_consent' => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => $customer2Id,
                'patient_id'    => 'VET-2025-0004',
                'pet_name'      => 'Cottontail',
                'species'       => 'Rabbit',
                'species_id'    => $rabbitId,
                'breed'         => 'Holland Lop',
                'color'         => 'Gray & White',
                'birthdate'     => '2023-01-10',
                'sex'           => 'Female',
                'owner_name'    => 'Miguel Torres',
                'owner_contact' => '09981234567',
                'address'       => '456 Session Road, Baguio City',
                'privacy_consent' => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            // Customer 3 - Patricia Lim
            [
                'user_id'       => $customer3Id,
                'patient_id'    => 'VET-2025-0005',
                'pet_name'      => 'Bella',
                'species'       => 'Dog',
                'species_id'    => $dogId,
                'breed'         => 'Shih Tzu',
                'color'         => 'White & Brown',
                'birthdate'     => '2021-04-22',
                'sex'           => 'Female',
                'owner_name'    => 'Patricia Lim',
                'owner_contact' => '09991112222',
                'address'       => '789 Leonard Wood Rd, Baguio City',
                'privacy_consent' => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => $customer3Id,
                'patient_id'    => 'VET-2025-0006',
                'pet_name'      => 'Tweety',
                'species'       => 'Bird',
                'species_id'    => $birdId,
                'breed'         => 'Cockatiel',
                'color'         => 'Yellow & Gray',
                'birthdate'     => '2022-09-01',
                'sex'           => 'Male',
                'owner_name'    => 'Patricia Lim',
                'owner_contact' => '09991112222',
                'address'       => '789 Leonard Wood Rd, Baguio City',
                'privacy_consent' => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            // Walk-in pets (no user account)
            [
                'user_id'       => null,
                'patient_id'    => 'VET-2025-0007',
                'pet_name'      => 'Bruno',
                'species'       => 'Dog',
                'species_id'    => $dogId,
                'breed'         => 'Labrador',
                'color'         => 'Chocolate Brown',
                'birthdate'     => '2019-06-30',
                'sex'           => 'Male',
                'owner_name'    => 'Roberto Aquino',
                'owner_contact' => '09161234567',
                'address'       => '22 Trancoville, Baguio City',
                'privacy_consent' => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'user_id'       => null,
                'patient_id'    => 'VET-2025-0008',
                'pet_name'      => 'Luna',
                'species'       => 'Cat',
                'species_id'    => $catId,
                'breed'         => 'Domestic Shorthair',
                'color'         => 'Black',
                'birthdate'     => '2023-02-14',
                'sex'           => 'Female',
                'owner_name'    => 'Carmen Valdez',
                'owner_contact' => '09177654321',
                'address'       => '55 Burnham Park Area, Baguio City',
                'privacy_consent' => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ];

        DB::table('patients')->insert($patients);

        $luckyId     = DB::table('patients')->where('patient_id', 'VET-2025-0001')->value('id');
        $mistyId     = DB::table('patients')->where('patient_id', 'VET-2025-0002')->value('id');
        $rexId       = DB::table('patients')->where('patient_id', 'VET-2025-0003')->value('id');
        $bellaId     = DB::table('patients')->where('patient_id', 'VET-2025-0005')->value('id');
        $brunoId     = DB::table('patients')->where('patient_id', 'VET-2025-0007')->value('id');
        $lunaId      = DB::table('patients')->where('patient_id', 'VET-2025-0008')->value('id');

        // ================================================================
        // VISITS (past grooming history)
        // ================================================================
        $visits = [
    [
        'patient_id' => $luckyId, 'visit_date' => Carbon::now()->subDays(60)->toDateString(),
        'visit_time' => '09:00:00', 'service_type' => 'Full Grooming',
        'chief_complaint' => 'Regular grooming session', 'coat_condition' => 'Clean',
        'notes' => 'Well-behaved dog. Owner requested extra fluff dry.',
        'health_worker' => 'Juan Dela Cruz',
        'flea_tick_product' => null, 'flea_tick_area' => null,
        'created_at' => now(), 'updated_at' => now(),
    ],
    [
        'patient_id' => $luckyId, 'visit_date' => Carbon::now()->subDays(30)->toDateString(),
        'visit_time' => '10:00:00', 'service_type' => 'Bath & Dry',
        'chief_complaint' => 'Post-outdoor bath', 'coat_condition' => 'Dirty',
        'notes' => 'Came in muddy from outdoor play. Used hypoallergenic shampoo.',
        'health_worker' => 'Ana Reyes',
        'flea_tick_product' => null, 'flea_tick_area' => null,
        'created_at' => now(), 'updated_at' => now(),
    ],
    [
        'patient_id' => $luckyId, 'visit_date' => Carbon::now()->subDays(7)->toDateString(),
        'visit_time' => '14:00:00', 'service_type' => 'Nail Trimming',
        'chief_complaint' => 'Nails getting too long', 'coat_condition' => 'Clean',
        'notes' => 'Quick nail trim. Very cooperative.',
        'health_worker' => 'Juan Dela Cruz',
        'flea_tick_product' => null, 'flea_tick_area' => null,
        'created_at' => now(), 'updated_at' => now(),
    ],
    [
        'patient_id' => $mistyId, 'visit_date' => Carbon::now()->subDays(45)->toDateString(),
        'visit_time' => '11:00:00', 'service_type' => 'Full Grooming',
        'chief_complaint' => 'Coat getting matted', 'coat_condition' => 'Matted',
        'notes' => 'Matting around ears and belly. De-matting done carefully.',
        'health_worker' => 'Ana Reyes',
        'flea_tick_product' => null, 'flea_tick_area' => null,
        'created_at' => now(), 'updated_at' => now(),
    ],
    [
        'patient_id' => $mistyId, 'visit_date' => Carbon::now()->subDays(14)->toDateString(),
        'visit_time' => '13:00:00', 'service_type' => 'Ear Cleaning',
        'chief_complaint' => 'Scratching ears frequently', 'coat_condition' => 'Clean',
        'notes' => 'Mild ear wax buildup. Cleaned with ear solution.',
        'health_worker' => 'Juan Dela Cruz',
        'flea_tick_product' => null, 'flea_tick_area' => null,
        'created_at' => now(), 'updated_at' => now(),
    ],
    [
        'patient_id' => $rexId, 'visit_date' => Carbon::now()->subDays(90)->toDateString(),
        'visit_time' => '09:30:00', 'service_type' => 'De-shedding Treatment',
        'chief_complaint' => 'Heavy shedding season', 'coat_condition' => 'Shedding',
        'notes' => 'Heavy shedding. Full de-shed treatment applied.',
        'health_worker' => 'Ana Reyes',
        'flea_tick_product' => null, 'flea_tick_area' => null,
        'created_at' => now(), 'updated_at' => now(),
    ],
    [
        'patient_id' => $rexId, 'visit_date' => Carbon::now()->subDays(20)->toDateString(),
        'visit_time' => '15:00:00', 'service_type' => 'Flea & Tick Treatment',
        'chief_complaint' => 'Found ticks on coat', 'coat_condition' => 'Flea-Infested',
        'notes' => 'Applied Frontline Plus. Advised owner to check environment.',
        'health_worker' => 'Juan Dela Cruz',
        'flea_tick_product' => 'Frontline Plus', 'flea_tick_area' => 'Neck and back',
        'created_at' => now(), 'updated_at' => now(),
    ],
    [
        'patient_id' => $bellaId, 'visit_date' => Carbon::now()->subDays(10)->toDateString(),
        'visit_time' => '10:30:00', 'service_type' => 'Haircut & Styling',
        'chief_complaint' => 'Monthly trim', 'coat_condition' => 'Clean',
        'notes' => 'Puppy cut style. Owner very happy with result.',
        'health_worker' => 'Ana Reyes',
        'flea_tick_product' => null, 'flea_tick_area' => null,
        'created_at' => now(), 'updated_at' => now(),
    ],
    [
        'patient_id' => $brunoId, 'visit_date' => Carbon::now()->subDays(5)->toDateString(),
        'visit_time' => '11:30:00', 'service_type' => 'Bath & Dry',
        'chief_complaint' => 'Walk-in grooming', 'coat_condition' => 'Dirty',
        'notes' => 'Walk-in customer. Good temperament.',
        'health_worker' => 'Juan Dela Cruz',
        'flea_tick_product' => null, 'flea_tick_area' => null,
        'created_at' => now(), 'updated_at' => now(),
    ],
];

        DB::table('visits')->insert($visits);

        // ================================================================
        // APPOINTMENTS
        // ================================================================
        $appointments = [
    [
        'patient_id'       => $luckyId,
        'appointment_date' => Carbon::now()->addDays(3)->toDateString(),
        'appointment_time' => '09:00:00',
        'service_type'     => 'Full Grooming',
        'status'           => 'scheduled',
        'chief_complaint'  => 'Monthly grooming',
        'health_worker'    => 'Juan Dela Cruz',
        'is_walk_in'       => false,
        'created_at'       => now(), 'updated_at' => now(),
    ],
    [
        'patient_id'       => $mistyId,
        'appointment_date' => Carbon::now()->addDays(5)->toDateString(),
        'appointment_time' => '11:00:00',
        'service_type'     => 'Full Grooming',
        'status'           => 'confirmed',
        'chief_complaint'  => 'Coat maintenance',
        'health_worker'    => 'Ana Reyes',
        'is_walk_in'       => false,
        'created_at'       => now(), 'updated_at' => now(),
    ],
    [
        'patient_id'       => $rexId,
        'appointment_date' => Carbon::now()->addDays(1)->toDateString(),
        'appointment_time' => '14:00:00',
        'service_type'     => 'Bath & Dry',
        'status'           => 'scheduled',
        'chief_complaint'  => 'Regular bath',
        'health_worker'    => 'Juan Dela Cruz',
        'is_walk_in'       => false,
        'created_at'       => now(), 'updated_at' => now(),
    ],
    [
        'patient_id'       => $bellaId,
        'appointment_date' => Carbon::now()->addDays(7)->toDateString(),
        'appointment_time' => '10:00:00',
        'service_type'     => 'Haircut & Styling',
        'status'           => 'scheduled',
        'chief_complaint'  => 'Monthly haircut',
        'health_worker'    => 'Ana Reyes',
        'is_walk_in'       => false,
        'created_at'       => now(), 'updated_at' => now(),
    ],
    [
        'patient_id'       => $brunoId,
        'appointment_date' => Carbon::now()->toDateString(),
        'appointment_time' => '13:00:00',
        'service_type'     => 'Nail Trimming',
        'status'           => 'scheduled',
        'chief_complaint'  => 'Walk-in nail trim',
        'health_worker'    => 'Juan Dela Cruz',
        'is_walk_in'       => true,
        'created_at'       => now(), 'updated_at' => now(),
    ],
    [
        'patient_id'       => $luckyId,
        'appointment_date' => Carbon::now()->subDays(30)->toDateString(),
        'appointment_time' => '10:00:00',
        'service_type'     => 'Bath & Dry',
        'status'           => 'completed',
        'chief_complaint'  => 'Regular bath',
        'health_worker'    => 'Ana Reyes',
        'is_walk_in'       => false,
        'created_at'       => now(), 'updated_at' => now(),
    ],
    [
        'patient_id'       => $rexId,
        'appointment_date' => Carbon::now()->subDays(20)->toDateString(),
        'appointment_time' => '15:00:00',
        'service_type'     => 'Flea & Tick Treatment',
        'status'           => 'completed',
        'chief_complaint'  => 'Tick removal',
        'health_worker'    => 'Juan Dela Cruz',
        'is_walk_in'       => false,
        'created_at'       => now(), 'updated_at' => now(),
    ],
];

        DB::table('appointments')->insert($appointments);

        // ================================================================
        // PET HEALTH RECORDS
        // ================================================================
        // Only insert if the table exists (Issue #11 migration ran)
        if (DB::getSchemaBuilder()->hasTable('pet_health_records')) {
            $healthRecords = [
                [
                    'patient_id'     => $luckyId,
                    'condition'      => 'Skin Allergy',
                    'diagnosed_date' => '2023-06-10',
                    'medication'     => 'Apoquel 5.4mg',
                    'dosage'         => '1 tablet daily for 2 weeks',
                    'status'         => 'resolved',
                    'notes'          => 'Avoid products with artificial fragrance. Use hypoallergenic shampoo only.',
                    'recorded_by'    => $staffId,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ],
                [
                    'patient_id'     => $luckyId,
                    'condition'      => 'Seasonal Dry Skin',
                    'diagnosed_date' => '2024-01-15',
                    'medication'     => 'Omega-3 Supplement',
                    'dosage'         => '1 capsule daily with meals',
                    'status'         => 'monitoring',
                    'notes'          => 'Skin gets dry during cold season. Monitor coat condition each visit.',
                    'recorded_by'    => $adminId,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ],
                [
                    'patient_id'     => $mistyId,
                    'condition'      => 'Ear Infection (Otitis)',
                    'diagnosed_date' => '2024-03-20',
                    'medication'     => 'Otomax Ear Drops',
                    'dosage'         => '3 drops per ear, twice daily for 7 days',
                    'status'         => 'resolved',
                    'notes'          => 'Recurrence possible. Check ears at every visit. Keep ears dry after bathing.',
                    'recorded_by'    => $staffId,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ],
                [
                    'patient_id'     => $rexId,
                    'condition'      => 'Flea Allergy Dermatitis',
                    'diagnosed_date' => '2024-02-01',
                    'medication'     => 'Frontline Plus + Hydrocortisone Cream',
                    'dosage'         => 'Apply Frontline monthly. Cream on affected areas twice daily.',
                    'status'         => 'active',
                    'notes'          => 'Highly reactive to flea bites. Must apply preventive flea treatment every month without fail.',
                    'recorded_by'    => $adminId,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ],
                [
                    'patient_id'     => $bellaId,
                    'condition'      => 'Tear Staining',
                    'diagnosed_date' => '2023-11-05',
                    'medication'     => 'Angels Eyes Supplement',
                    'dosage'         => '1/4 teaspoon daily on food',
                    'status'         => 'monitoring',
                    'notes'          => 'Common in Shih Tzu breed. Clean face daily with damp cloth. Trim hair around eyes regularly.',
                    'recorded_by'    => $staff2Id,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ],
            ];

            DB::table('pet_health_records')->insert($healthRecords);
        }

        // ================================================================
        // APPOINTMENT REQUESTS (from customers)
        // ================================================================
        if (DB::getSchemaBuilder()->hasTable('appointment_requests')) {
            $requests = [
    [
        'user_id'          => $customer1Id,
        'patient_id'       => $luckyId,
        'requested_date'   => Carbon::now()->addDays(10)->toDateString(),
        'requested_time'   => '10:00 AM',
        'service_type'     => 'Full Grooming',
        'status'           => 'pending',
        'preferred_notes'  => 'Please use the hypoallergenic shampoo. Lucky has sensitive skin.',
        'rejection_reason' => null,
        'created_at'       => now(),
        'updated_at'       => now(),
    ],
    [
        'user_id'          => $customer2Id,
        'patient_id'       => $rexId,
        'requested_date'   => Carbon::now()->addDays(4)->toDateString(),
        'requested_time'   => '2:00 PM',
        'service_type'     => 'Flea & Tick Treatment',
        'status'           => 'approved',
        'preferred_notes'  => 'Monthly flea prevention treatment.',
        'rejection_reason' => null,
        'created_at'       => now(),
        'updated_at'       => now(),
    ],
    [
        'user_id'          => $customer3Id,
        'patient_id'       => $bellaId,
        'requested_date'   => Carbon::now()->subDays(2)->toDateString(),
        'requested_time'   => '9:00 AM',
        'service_type'     => 'Haircut & Styling',
        'status'           => 'rejected',
        'preferred_notes'  => 'Puppy cut please.',
        'rejection_reason' => 'Fully booked on that day. Please choose another date.',
        'created_at'       => now(),
        'updated_at'       => now(),
    ],
];

            DB::table('appointment_requests')->insert($requests);
        }

        $this->command->info('');
        $this->command->info('✅ FURCARE dummy data seeded successfully!');
        $this->command->info('');
        $this->command->info('=== LOGIN CREDENTIALS ===');
        $this->command->info('Super Admin : superadmin@furcare.com / password123');
        $this->command->info('Admin       : admin@furcare.com / password123');
        $this->command->info('Staff       : staff@furcare.com / password123');
        $this->command->info('Staff 2     : staff2@furcare.com / password123');
        $this->command->info('Customer 1  : customer1@furcare.com / password123');
        $this->command->info('Customer 2  : customer2@furcare.com / password123');
        $this->command->info('Customer 3  : customer3@furcare.com / password123');
        $this->command->info('');
        $this->command->info('=== DATA SUMMARY ===');
        $this->command->info('7 users (1 super admin, 1 admin, 2 staff, 3 customers)');
        $this->command->info('8 pets across all customers + walk-ins');
        $this->command->info('9 past visits with grooming details');
        $this->command->info('7 appointments (upcoming + completed)');
        $this->command->info('5 health records with conditions & medications');
        $this->command->info('3 appointment requests (pending/approved/rejected)');
    }
}