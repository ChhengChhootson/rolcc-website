<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            // Content
            'view sermons', 'create sermons', 'edit sermons', 'delete sermons',
            'view events', 'create events', 'edit events', 'delete events', 'manage registrations',
            'view ministries', 'create ministries', 'edit ministries', 'delete ministries',
            'view blogs', 'create blogs', 'edit blogs', 'delete blogs',
            'view gallery', 'create gallery', 'edit gallery', 'delete gallery',
            'view leadership', 'create leadership', 'edit leadership', 'delete leadership',
            'view pages', 'create pages', 'edit pages', 'delete pages',

            // Communication
            'view prayer requests', 'manage prayer requests',
            'view newsletter', 'manage newsletter',
            'view messages', 'reply messages',
            'view testimonials', 'approve testimonials', 'delete testimonials',
            'view announcements', 'create announcements', 'edit announcements', 'delete announcements',

            // Finance
            'view donations', 'manage donations', 'delete donations',
            'view donation categories', 'manage donation categories',

            // Media
            'view media', 'upload media', 'delete media',

            // Users
            'view users', 'create users', 'edit users', 'delete users',
            'assign roles',

            // Settings
            'view settings', 'edit settings',

            // Logs
            'view activity logs',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles with permissions
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::all());

        $editor = Role::firstOrCreate(['name' => 'editor']);
        $editor->givePermissionTo([
            'view sermons', 'create sermons', 'edit sermons', 'delete sermons',
            'view events', 'create events', 'edit events', 'delete events', 'manage registrations',
            'view ministries', 'create ministries', 'edit ministries',
            'view blogs', 'create blogs', 'edit blogs', 'delete blogs',
            'view gallery', 'create gallery', 'edit gallery', 'delete gallery',
            'view leadership', 'create leadership', 'edit leadership',
            'view pages', 'create pages', 'edit pages',
            'view testimonials', 'approve testimonials',
            'view announcements', 'create announcements', 'edit announcements',
            'view media', 'upload media',
            'view prayer requests', 'manage prayer requests',
            'view newsletter',
            'view messages', 'reply messages',
        ]);

        $mediaManager = Role::firstOrCreate(['name' => 'media_manager']);
        $mediaManager->givePermissionTo([
            'view gallery', 'create gallery', 'edit gallery', 'delete gallery',
            'view media', 'upload media', 'delete media',
        ]);

        $eventManager = Role::firstOrCreate(['name' => 'event_manager']);
        $eventManager->givePermissionTo([
            'view events', 'create events', 'edit events', 'delete events', 'manage registrations',
            'view media', 'upload media',
        ]);

        $financeAdmin = Role::firstOrCreate(['name' => 'finance_admin']);
        $financeAdmin->givePermissionTo([
            'view donations', 'manage donations',
            'view donation categories', 'manage donation categories',
        ]);

        $this->command->info('✓ Roles and permissions created');
    }
}
