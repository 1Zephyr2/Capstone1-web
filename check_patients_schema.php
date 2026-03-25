<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

try {
    echo "Patients table columns:\n";
    $columns = Schema::getColumnListing('patients');
    print_r($columns);
    
    echo "\n\nTable info:\n";
    $info = DB::select("PRAGMA table_info(patients)");
    foreach ($info as $column) {
        echo "{$column->name} ({$column->type})\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
