<?php

namespace Database\Seeders;

use App\Models\SermonCategory;
use Illuminate\Database\Seeder;

class SermonCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Sunday Service', 'slug' => 'sunday-service', 'color' => '#145DA0', 'order' => 1],
            ['name' => 'Revival', 'slug' => 'revival', 'color' => '#EF4444', 'order' => 2],
            ['name' => 'Prayer & Fasting', 'slug' => 'prayer-fasting', 'color' => '#3C8DDB', 'order' => 3],
            ['name' => 'Youth', 'slug' => 'youth', 'color' => '#F59E0B', 'order' => 4],
            ['name' => 'Conference', 'slug' => 'conference', 'color' => '#8B5CF6', 'order' => 5],
            ['name' => 'Women of God', 'slug' => 'women', 'color' => '#EC4899', 'order' => 6],
            ['name' => 'Leadership', 'slug' => 'leadership', 'color' => '#0B4F8C', 'order' => 7],
            ['name' => 'Evangelism', 'slug' => 'evangelism', 'color' => '#22C55E', 'order' => 8],
            ['name' => 'Christmas & Easter', 'slug' => 'special-occasions', 'color' => '#D4A017', 'order' => 9],
        ];

        foreach ($categories as $cat) {
            SermonCategory::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        $this->command->info('✓ Sermon categories seeded');
    }
}
