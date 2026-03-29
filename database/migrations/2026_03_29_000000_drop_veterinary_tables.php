<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations - drop all veterinary-related tables
     */
    public function up(): void
    {
        Schema::dropIfExists('immunizations');
        Schema::dropIfExists('vital_signs');
        Schema::dropIfExists('prenatal_records');
        Schema::dropIfExists('breeding_records');
        Schema::dropIfExists('referrals');
    }

    /**
     * Reverse the migrations
     */
    public function down(): void
    {
        // Not implemented - this is a one-way cleanup migration
        // Veterinary features are no longer part of the grooming system
    }
};
