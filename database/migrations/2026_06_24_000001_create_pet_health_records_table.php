<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pet_health_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->string('condition');           // e.g. "Skin Allergy", "Mange", "Ear Infection"
            $table->date('diagnosed_date')->nullable();
            $table->string('medication')->nullable(); // e.g. "Apoquel 5.4mg", "Medicated Shampoo"
            $table->string('dosage')->nullable();     // e.g. "1 tablet daily"
            $table->enum('status', ['active', 'resolved', 'monitoring'])->default('active');
            $table->text('notes')->nullable();        // e.g. "Avoid products with sulfate"
            $table->foreignId('recorded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet_health_records');
    }
};