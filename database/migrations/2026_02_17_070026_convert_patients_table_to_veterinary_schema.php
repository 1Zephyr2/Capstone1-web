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
            
            // SQLite doesn't support dropping/renaming columns easily, so we recreate the table
            Schema::table('patients', function (Blueprint $table) {
                $table->dropColumn([
                    'middle_name',
                    'philhealth_number',
                    'secondary_contact_name',
                    'secondary_contact_number',
                ]);
            });
            
            // Add new veterinary columns
            Schema::table('patients', function (Blueprint $table) {
                $table->string('pet_name')->after('patient_id')->nullable();
                $table->string('species')->after('pet_name')->nullable(); // Dog, Cat, Rabbit, etc.
                $table->string('breed')->after('species')->nullable();
                $table->string('color')->after('breed')->nullable();
                $table->string('owner_name')->after('color')->nullable();
                $table->string('owner_contact')->after('owner_name')->nullable();
                $table->string('microchip_number')->after('owner_contact')->nullable();
            });
            
            // Migrate data from old columns to new
            DB::statement("UPDATE patients SET pet_name = first_name, owner_name = last_name, owner_contact = contact_number");
            
            // Now drop the old columns
            Schema::table('patients', function (Blueprint $table) {
                $table->dropColumn(['first_name', 'last_name', 'contact_number']);
            });
            
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
