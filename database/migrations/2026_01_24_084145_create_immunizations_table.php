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
        Schema::create('immunizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->string('vaccine_name'); // BCG, Hepatitis B, Pentavalent, etc.
            $table->integer('dose_number')->nullable(); // 1st, 2nd, 3rd dose
            $table->date('date_given');
            $table->date('next_dose_due')->nullable();
            $table->string('batch_number')->nullable();
            $table->string('administered_by')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            
            $table->index(['patient_id', 'vaccine_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('immunizations');
    }
};
