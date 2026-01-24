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
        Schema::create('prenatal_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->date('lmp')->nullable(); // Last Menstrual Period
            $table->date('edd')->nullable(); // Expected Date of Delivery (auto-calculated)
            $table->date('visit_date');
            $table->integer('gestational_age_weeks')->nullable(); // Auto-calculated
            $table->decimal('weight', 5, 2)->nullable();
            $table->string('blood_pressure')->nullable();
            $table->decimal('fundal_height', 4, 1)->nullable(); // cm
            $table->string('fetal_heart_tone')->nullable(); // e.g., "140 bpm"
            $table->text('risk_factors')->nullable(); // High BP, anemia, etc.
            $table->boolean('referred')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('patient_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prenatal_records');
    }
};
