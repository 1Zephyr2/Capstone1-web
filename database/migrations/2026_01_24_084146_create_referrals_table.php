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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('visit_id')->nullable()->constrained()->onDelete('set null');
            $table->date('referral_date');
            $table->string('referred_to'); // Hospital/facility name
            $table->text('reason');
            $table->enum('urgency', ['Routine', 'Urgent', 'Emergency'])->default('Routine');
            $table->boolean('completed')->default(false);
            $table->date('follow_up_date')->nullable();
            $table->text('outcome')->nullable();
            $table->timestamps();
            
            $table->index('patient_id');
            $table->index('referral_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
