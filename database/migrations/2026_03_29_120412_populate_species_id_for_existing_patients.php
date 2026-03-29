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
        // Populate species_id for existing patients based on matching species names
        $patients = DB::table('patients')->whereNull('species_id')->get();
        
        foreach ($patients as $patient) {
            if ($patient->species) {
                $species = DB::table('species')->where('name', $patient->species)->first();
                if ($species) {
                    DB::table('patients')
                        ->where('id', $patient->id)
                        ->update(['species_id' => $species->id]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reset species_id to null
        DB::table('patients')->update(['species_id' => null]);
    }
};
