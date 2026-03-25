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
        Schema::table('patients', function (Blueprint $table) {
            $table->unsignedBigInteger('species_id')->nullable()->after('species');
            $table->boolean('is_required')->default(false)->after('species_id'); // Mark pets requiring special care
            $table->boolean('privacy_consent')->default(false)->after('is_required'); // Data privacy consent
            $table->foreign('species_id')->references('id')->on('species')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign(['species_id']);
            $table->dropColumn(['species_id', 'is_required', 'privacy_consent']);
        });
    }
};
