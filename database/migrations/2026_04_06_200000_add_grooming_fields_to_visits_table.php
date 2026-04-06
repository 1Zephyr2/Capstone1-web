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
        $columnsToAdd = [];

        if (!Schema::hasColumn('visits', 'coat_condition')) {
            $columnsToAdd[] = 'coat_condition';
        }
        if (!Schema::hasColumn('visits', 'behavior')) {
            $columnsToAdd[] = 'behavior';
        }
        if (!Schema::hasColumn('visits', 'grooming_notes')) {
            $columnsToAdd[] = 'grooming_notes';
        }
        if (!Schema::hasColumn('visits', 'flea_tick_product')) {
            $columnsToAdd[] = 'flea_tick_product';
        }
        if (!Schema::hasColumn('visits', 'flea_tick_area')) {
            $columnsToAdd[] = 'flea_tick_area';
        }
        if (!Schema::hasColumn('visits', 'nail_condition_before')) {
            $columnsToAdd[] = 'nail_condition_before';
        }
        if (!Schema::hasColumn('visits', 'nail_condition_after')) {
            $columnsToAdd[] = 'nail_condition_after';
        }
        if (!Schema::hasColumn('visits', 'dental_notes')) {
            $columnsToAdd[] = 'dental_notes';
        }
        if (!Schema::hasColumn('visits', 'shedding_amount')) {
            $columnsToAdd[] = 'shedding_amount';
        }
        if (!Schema::hasColumn('visits', 'hair_removed')) {
            $columnsToAdd[] = 'hair_removed';
        }
        if (!Schema::hasColumn('visits', 'boarding_observations')) {
            $columnsToAdd[] = 'boarding_observations';
        }

        if (empty($columnsToAdd)) {
            return;
        }

        Schema::table('visits', function (Blueprint $table) use ($columnsToAdd) {
            foreach ($columnsToAdd as $column) {
                $table->text($column)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $columnsToDrop = [
            'coat_condition',
            'behavior',
            'grooming_notes',
            'flea_tick_product',
            'flea_tick_area',
            'nail_condition_before',
            'nail_condition_after',
            'dental_notes',
            'shedding_amount',
            'hair_removed',
            'boarding_observations',
        ];

        $existingColumns = array_values(array_filter($columnsToDrop, function (string $column) {
            return Schema::hasColumn('visits', $column);
        }));

        if (empty($existingColumns)) {
            return;
        }

        Schema::table('visits', function (Blueprint $table) use ($existingColumns) {
            $table->dropColumn($existingColumns);
        });
    }
};
