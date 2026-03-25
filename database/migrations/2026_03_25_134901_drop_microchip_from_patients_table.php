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
        // SQLite doesn't support dropping indexes before columns reliably
        // So we use raw SQL to drop the index first if DB is SQLite
        if (DB::connection()->getDriverName() === 'sqlite') {
            try {
                DB::statement('DROP INDEX IF EXISTS idx_patients_microchip');
            } catch (\Exception $e) {
                // Index might not exist with that name, continue
            }
        }
        
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('microchip_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('microchip_number')->nullable();
        });
    }
};
