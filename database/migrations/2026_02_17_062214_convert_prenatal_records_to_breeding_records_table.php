<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Rename table from prenatal_records to breeding_records
        Schema::rename('prenatal_records', 'breeding_records');
        
        // Update columns for animal breeding
        Schema::table('breeding_records', function (Blueprint $table) {
            // Drop human pregnancy columns
            $table->dropColumn([
                'lmp',
                'edd',
                'gestational_age_weeks',
                'fundal_height',
                'fetal_heart_tone',
                'blood_pressure'
            ]);
            
            // Add animal breeding columns
            $table->date('breeding_date')->nullable()->after('patient_id'); // Date of breeding/mating
            $table->string('sire')->nullable()->after('breeding_date'); // Male parent info
            $table->string('dam')->nullable()->after('sire'); // Female parent info (usually the patient)
            $table->date('heat_cycle_date')->nullable()->after('dam'); // Date heat cycle started
            $table->date('pregnancy_confirmed_date')->nullable()->after('heat_cycle_date');
            $table->date('expected_delivery_date')->nullable()->after('pregnancy_confirmed_date'); // Whelping/kindling date
            $table->integer('litter_size')->nullable()->after('expected_delivery_date');
            $table->enum('breeding_status', ['Planned', 'Bred', 'Confirmed Pregnant', 'Not Pregnant', 'Delivered'])->default('Planned')->after('litter_size');
            
            // Rename visit_date to checkup_date for clarity
            $table->renameColumn('visit_date', 'checkup_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert column changes
        Schema::table('breeding_records', function (Blueprint $table) {
            // Drop animal breeding columns
            $table->dropColumn([
                'breeding_date',
                'sire',
                'dam',
                'heat_cycle_date',
                'pregnancy_confirmed_date',
                'expected_delivery_date',
                'litter_size',
                'breeding_status'
            ]);
            
            // Restore human pregnancy columns
            $table->date('lmp')->nullable();
            $table->date('edd')->nullable();
            $table->integer('gestational_age_weeks')->nullable();
            $table->decimal('fundal_height', 4, 1)->nullable();
            $table->string('fetal_heart_tone')->nullable();
            $table->string('blood_pressure')->nullable();
            
            // Rename checkup_date back to visit_date
            $table->renameColumn('checkup_date', 'visit_date');
        });
        
        // Rename table back to prenatal_records
        Schema::rename('breeding_records', 'prenatal_records');
    }
};
