<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations to convert patients table to veterinary schema.
     */
    public function up(): void
    {
        $driver = DB::getDriverName();
        
        if ($driver === 'sqlite') {
            // Drop existing indexes first
            try {
                DB::statement('DROP INDEX IF EXISTS patients_last_name_first_name_index');
                DB::statement('DROP INDEX IF EXISTS patients_contact_number_index');
                DB::statement('DROP INDEX IF EXISTS patients_philhealth_number_index');
            } catch (\Exception $e) {
                // Indexes might not exist, continue
            }

            // Only drop columns that actually exist (guard for idempotency)
            $toDrop = array_filter(
                ['middle_name', 'philhealth_number', 'secondary_contact_name', 'secondary_contact_number'],
                fn($col) => Schema::hasColumn('patients', $col)
            );
            if (!empty($toDrop)) {
                Schema::table('patients', function (Blueprint $table) use ($toDrop) {
                    $table->dropColumn(array_values($toDrop));
                });
            }

            // Add new veterinary columns only if they don't already exist
            Schema::table('patients', function (Blueprint $table) {
                if (!Schema::hasColumn('patients', 'pet_name')) {
                    $table->string('pet_name')->after('patient_id')->nullable();
                }
                if (!Schema::hasColumn('patients', 'species')) {
                    $table->string('species')->after('pet_name')->nullable();
                }
                if (!Schema::hasColumn('patients', 'breed')) {
                    $table->string('breed')->after('species')->nullable();
                }
                if (!Schema::hasColumn('patients', 'color')) {
                    $table->string('color')->after('breed')->nullable();
                }
                if (!Schema::hasColumn('patients', 'owner_name')) {
                    $table->string('owner_name')->after('color')->nullable();
                }
                if (!Schema::hasColumn('patients', 'owner_contact')) {
                    $table->string('owner_contact')->after('owner_name')->nullable();
                }
                if (!Schema::hasColumn('patients', 'microchip_number')) {
                    $table->string('microchip_number')->after('owner_contact')->nullable();
                }
            });

            // Migrate data only if old columns exist
            if (Schema::hasColumn('patients', 'first_name')) {
                DB::statement("UPDATE patients SET pet_name = first_name, owner_name = last_name, owner_contact = contact_number");
            }

            // Drop old columns only if they exist
            $oldColumns = array_filter(
                ['first_name', 'last_name', 'contact_number'],
                fn($col) => Schema::hasColumn('patients', $col)
            );
            if (!empty($oldColumns)) {
                Schema::table('patients', function (Blueprint $table) use ($oldColumns) {
                    $table->dropColumn(array_values($oldColumns));
                });
            }

            // Add indexes
            DB::statement('CREATE INDEX IF NOT EXISTS idx_patients_pet_species ON patients(pet_name, species)');
            DB::statement('CREATE INDEX IF NOT EXISTS idx_patients_owner_name ON patients(owner_name)');
            DB::statement('CREATE INDEX IF NOT EXISTS idx_patients_owner_contact ON patients(owner_contact)');
            DB::statement('CREATE INDEX IF NOT EXISTS idx_patients_microchip ON patients(microchip_number)');
            
        } else {
            // MySQL/PostgreSQL version
            Schema::table('patients', function (Blueprint $table) {
                // Add new columns
                $table->string('pet_name')->after('patient_id')->nullable();
                $table->string('species')->after('pet_name')->nullable();
                $table->string('breed')->after('species')->nullable();
                $table->string('color')->after('breed')->nullable();
                $table->string('owner_name')->after('color')->nullable();
                $table->string('owner_contact')->after('owner_name')->nullable();
                $table->string('microchip_number')->after('owner_contact')->nullable();
            });
            
            // Migrate data
            DB::statement("UPDATE patients SET pet_name = first_name, owner_name = last_name, owner_contact = contact_number");
            
            // Drop old columns
            Schema::table('patients', function (Blueprint $table) {
                $table->dropColumn([
                    'first_name',
                    'middle_name',
                    'last_name',
                    'contact_number',
                    'philhealth_number',
                    'secondary_contact_name',
                    'secondary_contact_number',
                ]);
                
                // Add indexes
                $table->index(['pet_name', 'species']);
                $table->index('owner_name');
                $table->index('owner_contact');
                $table->index('microchip_number');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            // Add back human health columns
            $table->string('first_name')->after('patient_id')->nullable();
            $table->string('middle_name')->after('first_name')->nullable();
            $table->string('last_name')->after('middle_name')->nullable();
            $table->string('contact_number')->after('address')->nullable();
            $table->string('philhealth_number')->after('contact_number')->nullable();
            $table->string('secondary_contact_name')->nullable();
            $table->string('secondary_contact_number')->nullable();
        });
        
        // Migrate data back
        DB::statement("UPDATE patients SET first_name = pet_name, last_name = owner_name, contact_number = owner_contact");
        
        // Drop veterinary columns
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn([
                'pet_name',
                'species',
                'breed',
                'color',
                'owner_name',
                'owner_contact',
                'microchip_number',
            ]);
        });
    }
};
