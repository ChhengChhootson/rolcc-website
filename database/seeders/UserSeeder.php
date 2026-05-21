<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@rolcccambodia.org'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('ROLCC@2024!'),
                'is_admin' => true,
                'status' => 'active',
                'email_verified_at' => now(),
                'position' => 'Super Administrator',
            ]
        );
        $superAdmin->assignRole('super_admin');

        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@rolcccambodia.org'],
            [
                'name' => 'Church Admin',
                'password' => Hash::make('Admin@2024!'),
                'is_admin' => true,
                'status' => 'active',
                'email_verified_at' => now(),
                'position' => 'Church Administrator',
            ]
        );
        $admin->assignRole('editor');

        // Pastor
        $pastor = User::firstOrCreate(
            ['email' => 'pastor@rolcccambodia.org'],
            [
                'name' => 'Pastor John Doe',
                'password' => Hash::make('Pastor@2024!'),
                'is_admin' => true,
                'status' => 'active',
                'email_verified_at' => now(),
                'position' => 'Senior Pastor',
            ]
        );
        $pastor->assignRole('editor');

        // Event Manager
        $eventManager = User::firstOrCreate(
            ['email' => 'events@rolcccambodia.org'],
            [
                'name' => 'Event Coordinator',
                'password' => Hash::make('Events@2024!'),
                'is_admin' => true,
                'status' => 'active',
                'email_verified_at' => now(),
                'position' => 'Event Manager',
            ]
        );
        $eventManager->assignRole('event_manager');

        // Demo member
        User::firstOrCreate(
            ['email' => 'member@rolcccambodia.org'],
            [
                'name' => 'Demo Member',
                'password' => Hash::make('Member@2024!'),
                'is_church_member' => true,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✓ Users created');
        $this->command->line('  Super Admin: superadmin@rolcccambodia.org / ROLCC@2024!');
        $this->command->line('  Admin: admin@rolcccambodia.org / Admin@2024!');
    }
}
