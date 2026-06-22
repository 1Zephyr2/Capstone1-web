<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // SQLite doesn't support ALTER COLUMN, so we need to
        // recreate the table with the updated CHECK constraint

        // 1. Copy all existing users to a temp table
        DB::statement('CREATE TABLE users_backup AS SELECT * FROM users');

        // 2. Drop the original table
        Schema::drop('users');

        // 3. Recreate with super_admin added to the role constraint
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('profile_picture')->nullable();
            $table->enum('role', ['super_admin', 'admin', 'staff', 'customer'])->default('customer');
            $table->rememberToken();
            $table->timestamps();
        });

        // 4. Restore all existing users
        DB::statement('INSERT INTO users SELECT * FROM users_backup');

        // 5. Drop the backup table
        DB::statement('DROP TABLE users_backup');

        // 6. Create the super admin account
        DB::table('users')->insert([
            'name'       => 'Super Administrator',
            'username'   => 'superadmin',
            'email'      => 'superadmin@furcare.local',
            'password'   => Hash::make('SuperAdmin@2026'),
            'role'       => 'super_admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        // Remove super admin account
        DB::table('users')->where('username', 'superadmin')->delete();

        // Revert table back to original constraint
        DB::statement('CREATE TABLE users_backup AS SELECT * FROM users');
        Schema::drop('users');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('profile_picture')->nullable();
            $table->enum('role', ['admin', 'staff', 'customer'])->default('customer');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement('INSERT INTO users SELECT * FROM users_backup');
        DB::statement('DROP TABLE users_backup');
    }
};