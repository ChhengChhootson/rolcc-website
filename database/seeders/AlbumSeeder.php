<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\User;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('is_admin', true)->first();

        $albums = [
            ['title' => 'Annual Conference 2024', 'slug' => 'annual-conference-2024', 'description' => 'Highlights from our 2024 Annual Conference', 'album_type' => 'photo', 'event_name' => 'Annual Conference', 'event_date' => now()->subMonths(3), 'is_featured' => true, 'status' => 'published'],
            ['title' => 'Christmas Celebration 2024', 'slug' => 'christmas-2024', 'description' => 'Beautiful memories from our Christmas celebration', 'album_type' => 'photo', 'event_name' => 'Christmas Service', 'event_date' => now()->subMonths(5), 'is_featured' => true, 'status' => 'published'],
            ['title' => 'Youth Camp 2024', 'slug' => 'youth-camp-2024', 'description' => 'Youth Ministry annual camp memories', 'album_type' => 'mixed', 'event_name' => 'Youth Camp', 'event_date' => now()->subMonths(6), 'is_featured' => false, 'status' => 'published'],
            ['title' => 'Community Outreach', 'slug' => 'community-outreach-2024', 'description' => 'Serving our community with love', 'album_type' => 'photo', 'event_name' => 'Outreach Program', 'event_date' => now()->subMonths(2), 'is_featured' => false, 'status' => 'published'],
        ];

        foreach ($albums as $album) {
            Album::firstOrCreate(
                ['slug' => $album['slug']],
                array_merge($album, [
                    'author_id' => $admin?->id,
                    'published_at' => now(),
                ])
            );
        }

        $this->command->info('✓ Albums seeded');
    }
}
