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
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            // SQLite: Recreate table without enum constraint
            Schema::table('visits', function (Blueprint $table) {
                // Change enum to string - SQLite doesn't support modifying enums
                // We need to drop and recreate
            });
            
            // Drop the old enum constraint by recreating the table
            DB::statement('
                CREATE TABLE visits_new AS
                SELECT id, patient_id, visit_date, visit_time, service_type, chief_complaint, notes, health_worker, created_at, updated_at
                FROM visits;
            ');
            
            DB::statement('DROP TABLE visits;');
            
            DB::statement('
                CREATE TABLE visits (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    patient_id INTEGER NOT NULL,
                    visit_date DATE NOT NULL,
                    visit_time TIME,
                    service_type VARCHAR(255) NOT NULL,
                    chief_complaint TEXT,
                    notes TEXT,
                    health_worker VARCHAR(255),
                    created_at TIMESTAMP,
                    updated_at TIMESTAMP,
                    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE
                );
            ');
            
            DB::statement('CREATE INDEX idx_patient_visit ON visits(patient_id, visit_date);');
            DB::statement('CREATE INDEX idx_visit_date ON visits(visit_date);');
            
            DB::statement('
                INSERT INTO visits (id, patient_id, visit_date, visit_time, service_type, chief_complaint, notes, health_worker, created_at, updated_at)
                SELECT id, patient_id, visit_date, visit_time, service_type, chief_complaint, notes, health_worker, created_at, updated_at
                FROM visits_new;
            ');
            
            DB::statement('DROP TABLE visits_new;');
        } else {
            // MySQL/MariaDB: update the ENUM to include all service types
            DB::statement("ALTER TABLE visits MODIFY COLUMN service_type ENUM(
                'Bath & Dry',
                'Full Grooming',
                'Haircut & Styling',
                'Nail Trimming',
                'Ear Cleaning',
                'Teeth Brushing',
                'De-shedding Treatment',
                'Flea & Tick Treatment',
                'Paw Treatment',
                'Vaccination',
                'Spay/Neuter',
                'Dental Cleaning',
                'Deworming',
                'General Checkup',
                'Wound Treatment',
                'Boarding Checkup',
                'Follow-up',
                'Referral',
                'Other'
            ) NOT NULL DEFAULT 'Other'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not reversible due to complexity of table recreation
    }
};
