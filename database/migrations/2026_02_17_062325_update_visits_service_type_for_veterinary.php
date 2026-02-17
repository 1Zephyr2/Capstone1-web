<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        
        if ($driver === 'sqlite') {
            // For SQLite, recreate the table with new enum values
            Schema::create('visits_new', function (Blueprint $table) {
                $table->id();
                $table->foreignId('patient_id')->constrained()->onDelete('cascade');
                $table->date('visit_date');
                $table->time('visit_time')->nullable();
                $table->enum('service_type', [
                    'Wellness Exam',
                    'Vaccination',
                    'Surgery',
                    'Dental Cleaning',
                    'Emergency',
                    'Grooming',
                    'Boarding Checkup',
                    'Follow-up',
                    'Diagnostics',
                    'Spay/Neuter',
                    'Breeding Consultation',
                    'Other'
                ])->default('Wellness Exam');
                $table->text('chief_complaint')->nullable();
                $table->text('notes')->nullable();
                $table->string('health_worker')->nullable();
                $table->timestamps();
                
                $table->index(['patient_id', 'visit_date']);
                $table->index('visit_date');
            });
            
            // Copy data with updated service types
            DB::statement("
                INSERT INTO visits_new (id, patient_id, visit_date, visit_time, service_type, chief_complaint, notes, health_worker, created_at, updated_at)
                SELECT 
                    id,
                    patient_id,
                    visit_date,
                    visit_time,
                    CASE service_type
                        WHEN 'General Checkup' THEN 'Wellness Exam'
                        WHEN 'Immunization' THEN 'Vaccination'
                        WHEN 'Prenatal' THEN 'Breeding Consultation'
                        WHEN 'Family Planning' THEN 'Spay/Neuter'
                        WHEN 'Referral' THEN 'Follow-up'
                        WHEN 'Health Education' THEN 'Wellness Exam'
                        ELSE 'Other'
                    END,
                    chief_complaint,
                    notes,
                    health_worker,
                    created_at,
                    updated_at
                FROM visits
            ");
            
            // Drop old table and rename new one
            Schema::dropIfExists('visits');
            Schema::rename('visits_new', 'visits');
        } else {
            // For MySQL/PostgreSQL
            DB::statement("ALTER TABLE visits MODIFY COLUMN service_type ENUM(
                'Wellness Exam',
                'Vaccination',
                'Surgery',
                'Dental Cleaning',
                'Emergency',
                'Grooming',
                'Boarding Checkup',
                'Follow-up',
                'Diagnostics',
                'Spay/Neuter',
                'Breeding Consultation',
                'Other'
            ) NOT NULL DEFAULT 'Wellness Exam'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        
        if ($driver === 'sqlite') {
            // Recreate with old values
            Schema::create('visits_old', function (Blueprint $table) {
                $table->id();
                $table->foreignId('patient_id')->constrained()->onDelete('cascade');
                $table->date('visit_date');
                $table->time('visit_time')->nullable();
                $table->enum('service_type', ['General Checkup', 'Immunization', 'Prenatal', 'Family Planning', 'Referral', 'Health Education', 'Other']);
                $table->text('chief_complaint')->nullable();
                $table->text('notes')->nullable();
                $table->string('health_worker')->nullable();
                $table->timestamps();
                
                $table->index(['patient_id', 'visit_date']);
                $table->index('visit_date');
            });
            
            // Copy data back with reverted service types
            DB::statement("
                INSERT INTO visits_old (id, patient_id, visit_date, visit_time, service_type, chief_complaint, notes, health_worker, created_at, updated_at)
                SELECT 
                    id,
                    patient_id,
                    visit_date,
                    visit_time,
                    CASE service_type
                        WHEN 'Wellness Exam' THEN 'General Checkup'
                        WHEN 'Vaccination' THEN 'Immunization'
                        WHEN 'Breeding Consultation' THEN 'Prenatal'
                        WHEN 'Spay/Neuter' THEN 'Family Planning'
                        WHEN 'Follow-up' THEN 'Referral'
                        ELSE 'Other'
                    END,
                    chief_complaint,
                    notes,
                    health_worker,
                    created_at,
                    updated_at
                FROM visits
            ");
            
            Schema::dropIfExists('visits');
            Schema::rename('visits_old', 'visits');
        } else {
            // For MySQL/PostgreSQL
            DB::statement("ALTER TABLE visits MODIFY COLUMN service_type ENUM(
                'General Checkup',
                'Immunization',
                'Prenatal',
                'Family Planning',
                'Referral',
                'Health Education',
                'Other'
            ) NOT NULL DEFAULT 'General Checkup'");
        }
    }
};
