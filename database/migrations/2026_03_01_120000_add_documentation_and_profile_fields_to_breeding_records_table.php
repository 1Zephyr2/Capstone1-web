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
        Schema::table('breeding_records', function (Blueprint $table) {
            $table->enum('animal_size', ['Small', 'Big'])->nullable()->after('weight');
            $table->enum('behavior', ['Calm', 'Aggressive'])->nullable()->after('animal_size');
            $table->string('animal_photo_path')->nullable()->after('behavior');
            $table->string('owner_photo_path')->nullable()->after('animal_photo_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('breeding_records', function (Blueprint $table) {
            $table->dropColumn([
                'animal_size',
                'behavior',
                'animal_photo_path',
                'owner_photo_path',
            ]);
        });
    }
};
