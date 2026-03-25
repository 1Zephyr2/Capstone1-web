<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get the first admin user, or any user if no admin exists
        $user_id = DB::table('users')
            ->where('role', 'admin')
            ->orderBy('id')
            ->value('id');
        
        // If no admin user exists, use the first user
        if (!$user_id) {
            $user_id = DB::table('users')->orderBy('id')->value('id');
        }
        
        // Assign all NULL user_ids to this user
        if ($user_id) {
            DB::table('patients')
                ->whereNull('user_id')
                ->update(['user_id' => $user_id]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert by setting user_id back to NULL for patients we modified
        // Note: This is a simplified revert. In production, you'd track which records were modified.
        // For now, we'll leave the revert commented out to be safe
    }
};
