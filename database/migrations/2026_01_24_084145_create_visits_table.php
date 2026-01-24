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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->date('visit_date');
            $table->time('visit_time')->nullable();
            $table->enum('service_type', ['General Checkup', 'Immunization', 'Prenatal', 'Family Planning', 'Referral', 'Health Education', 'Other']);
            $table->text('chief_complaint')->nullable();
            $table->text('notes')->nullable();
            $table->string('health_worker')->nullable(); // Name of staff who attended
            $table->timestamps();
            
            $table->index(['patient_id', 'visit_date']);
            $table->index('visit_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
