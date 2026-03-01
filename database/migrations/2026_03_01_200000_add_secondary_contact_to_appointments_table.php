<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('secondary_contact_name')->nullable()->after('notes');
            $table->string('secondary_contact_number')->nullable()->after('secondary_contact_name');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['secondary_contact_name', 'secondary_contact_number']);
        });
    }
};
