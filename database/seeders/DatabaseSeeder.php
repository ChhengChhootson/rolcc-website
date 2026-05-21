<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            SermonCategorySeeder::class,
            SermonSeeder::class,
            MinistrySeeder::class,
            EventSeeder::class,
            AlbumSeeder::class,
            LeadershipSeeder::class,
            TestimonialSeeder::class,
            DonationCategorySeeder::class,
            BlogCategorySeeder::class,
            AnnouncementSeeder::class,
        ]);
    }
}
