<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('Grooming Services');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Seed default services
        DB::table('services')->insert([
    ['name' => 'Premium',      'category' => 'Grooming Packages', 'is_active' => true, 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Deluxe',       'category' => 'Grooming Packages', 'is_active' => true, 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Standard',     'category' => 'Grooming Packages', 'is_active' => true, 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Grande',       'category' => 'Grooming Packages', 'is_active' => true, 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'BP Signature', 'category' => 'Grooming Packages', 'is_active' => true, 'sort_order' => 5, 'created_at' => now(), 'updated_at' => now()],
    ['name' => 'Other',        'category' => 'Other Services',    'is_active' => true, 'sort_order' => 6, 'created_at' => now(), 'updated_at' => now()],
]);
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};