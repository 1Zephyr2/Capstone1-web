<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdatePasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update admin and staff account passwords to password123';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // Update admin user password
        $adminUpdated = User::where('username', 'admin')->update(['password' => Hash::make('password123')]);
        if ($adminUpdated > 0) {
            $this->info('Admin user password updated successfully!');
            $this->info('Username: admin');
            $this->info('Password: password123');
        } else {
            $this->warn('Admin user not found.');
        }

        $this->newLine();

        // Update staff user password
        $staffUpdated = User::where('username', 'staff')->update(['password' => Hash::make('password123')]);
        if ($staffUpdated > 0) {
            $this->info('Staff user password updated successfully!');
            $this->info('Username: staff');
            $this->info('Password: password123');
        } else {
            $this->warn('Staff user not found.');
        }

        $this->newLine();
        $this->info('Done!');
    }
}
