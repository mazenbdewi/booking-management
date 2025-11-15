<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class CreateInitialUsers extends Command
{
    protected $signature = 'make:initial-users';

    protected $description = 'Create the first Admin user and create Staff role';

    public function handle(): int
    {
        $this->info('Starting user creation...');

        // check for existing super admin
        if (User::role('super_admin')->exists()) {
            $this->warn('An Admin user already exists. This command can only be run once.');

            return self::FAILURE;
        }

        // create Admin user
        $adminName = $this->ask('Enter Admin name');
        $adminEmail = $this->ask('Enter Admin email');
        $adminPassword = $this->secret('Enter Admin password');

        $adminUser = User::create([
            'name' => $adminName,
            'email' => $adminEmail,
            'password' => bcrypt($adminPassword),
        ]);

        // create super_admin role
        $adminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $adminUser->assignRole($adminRole);

        $this->info("Admin user created: $adminEmail");

        // create staff role
        $staffRole = Role::firstOrCreate(['name' => 'staff']);

        $this->info('Staff role created successfully');

        $this->info('All initial setup completed successfully.');

        return self::SUCCESS;
    }
}
