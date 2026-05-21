<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Church News', 'slug' => 'church-news', 'color' => '#145DA0', 'order' => 1],
            ['name' => 'Devotionals', 'slug' => 'devotionals', 'color' => '#3C8DDB', 'order' => 2],
            ['name' => 'Ministry Updates', 'slug' => 'ministry-updates', 'color' => '#22C55E', 'order' => 3],
            ['name' => 'Testimonies', 'slug' => 'testimonies', 'color' => '#D4A017', 'order' => 4],
            ['name' => 'Events', 'slug' => 'events', 'color' => '#8B5CF6', 'order' => 5],
        ];

        foreach ($categories as $cat) {
            BlogCategory::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        $this->command->info('✓ Blog categories seeded');
    }
}
