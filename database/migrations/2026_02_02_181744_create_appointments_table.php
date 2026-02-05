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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('service_type');
            $table->text('chief_complaint')->nullable();
            $table->string('health_worker')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('scheduled'); // scheduled, completed, cancelled, no-show
            
            // Service-specific fields
            $table->string('vaccine_name')->nullable();
            $table->string('dose_number')->nullable();
            $table->integer('gestational_age')->nullable();
            $table->string('presentation')->nullable();
            $table->string('fp_method')->nullable();
            $table->string('referred_to')->nullable();
            $table->string('referral_urgency')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
