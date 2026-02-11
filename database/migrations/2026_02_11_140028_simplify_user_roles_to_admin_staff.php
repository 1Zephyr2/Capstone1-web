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
        // First ensure all healthcare_provider roles are converted to staff
        DB::table('users')
            ->where('role', 'healthcare_provider')
            ->update(['role' => 'staff']);
            
        // Update the enum to only allow admin and staff
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'staff'])->default('staff')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore the previous enum with healthcare_provider
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'healthcare_provider', 'staff'])->default('staff')->change();
        });
    }
};
