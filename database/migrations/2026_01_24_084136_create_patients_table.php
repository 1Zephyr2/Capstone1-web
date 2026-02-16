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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id')->unique(); // Auto-generated ID like VET-2026-0001
            $table->string('pet_name');
            $table->string('species'); // Dog, Cat, Bird, Rabbit, etc.
            $table->string('breed')->nullable();
            $table->string('color')->nullable();
            $table->date('birthdate');
            $table->enum('sex', ['Male', 'Female', 'Neutered Male', 'Spayed Female']);
            $table->string('owner_name');
            $table->string('owner_contact')->nullable();
            $table->text('address');
            $table->string('microchip_number')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes for fast searching
            $table->index(['pet_name', 'species']);
            $table->index('owner_name');
            $table->index('owner_contact');
            $table->index('microchip_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
