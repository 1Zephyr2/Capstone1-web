<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            // SQLite does not enforce ENUMs — no schema change needed.
            // Existing rows with old service types remain valid.
        } else {
            // MySQL/MariaDB: update the ENUM to include grooming services
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
                'Breeding Consultation',
                'Boarding Checkup',
                'Follow-up',
                'Other',
                'Vaccination',
                'Spay/Neuter',
                'Dental Cleaning',
                'Deworming',
                'General Checkup',
                'Wound Treatment',
                'Referral'
            ) NOT NULL DEFAULT 'Other'");
        }
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        if ($driver !== 'sqlite') {
            DB::statement("ALTER TABLE visits MODIFY COLUMN service_type ENUM(
                'Vaccination',
                'Spay/Neuter',
                'Dental Cleaning',
                'Deworming',
                'Breeding Consultation',
                'General Checkup',
                'Wound Treatment',
                'Boarding Checkup',
                'Referral',
                'Follow-up',
                'Other'
            ) NOT NULL DEFAULT 'Other'");
        }
    }
};
