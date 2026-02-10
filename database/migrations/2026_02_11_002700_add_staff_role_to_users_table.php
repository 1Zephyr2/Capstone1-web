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
        // First, drop the existing role column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        // Then add it back with the new enum values including 'staff'
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'healthcare_provider', 'staff'])->default('healthcare_provider')->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'healthcare_provider'])->default('healthcare_provider')->after('password');
        });
    }
};
