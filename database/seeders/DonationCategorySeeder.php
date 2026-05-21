<?php

namespace Database\Seeders;

use App\Models\DonationCategory;
use Illuminate\Database\Seeder;

class DonationCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Tithe', 'slug' => 'tithe', 'description' => 'Regular tithe giving to support the church ministry', 'icon' => '💰', 'is_active' => true, 'order' => 1],
            ['name' => 'Offering', 'slug' => 'offering', 'description' => 'General offering for church operations', 'icon' => '🙏', 'is_active' => true, 'order' => 2],
            ['name' => 'Missions', 'slug' => 'missions', 'description' => 'Support for local and international missions', 'icon' => '🌍', 'is_active' => true, 'order' => 3],
            ['name' => 'Building Fund', 'slug' => 'building-fund', 'description' => 'Support for church building and facility projects', 'icon' => '🏛️', 'is_active' => true, 'order' => 4],
            ['name' => 'Youth Ministry', 'slug' => 'youth-ministry', 'description' => 'Support for youth events and programs', 'icon' => '🔥', 'is_active' => true, 'order' => 5],
            ['name' => 'Community Outreach', 'slug' => 'community-outreach', 'description' => 'Support for community service and outreach programs', 'icon' => '❤️', 'is_active' => true, 'order' => 6],
            ['name' => 'Special Event', 'slug' => 'special-event', 'description' => 'Support for specific events and conferences', 'icon' => '⭐', 'is_active' => true, 'order' => 7],
        ];

        foreach ($categories as $cat) {
            DonationCategory::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        $this->command->info('✓ Donation categories seeded');
    }
}
