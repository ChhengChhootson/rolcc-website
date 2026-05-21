<?php

namespace Database\Seeders;

use App\Models\Sermon;
use App\Models\SermonCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class SermonSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::where('email', 'pastor@rolcccambodia.org')->first()
            ?? User::where('is_admin', true)->first();

        $category = SermonCategory::where('slug', 'sunday-service')->first();

        $sermons = [
            [
                'title' => 'Walking in the Spirit',
                'description' => 'Discover what it means to live a Spirit-filled life and how to walk daily in the power and guidance of the Holy Spirit.',
                'speaker' => 'Pastor John Doe',
                'scripture_reference' => 'Galatians 5:16-25',
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'video_embed_id' => 'dQw4w9WgXcQ',
                'status' => 'published',
                'is_featured' => true,
                'language' => 'en',
                'preached_date' => now()->subWeeks(1),
            ],
            [
                'title' => 'The Power of Prayer',
                'description' => 'Explore the transforming power of prayer and how it connects us to God\'s heart and purposes for our lives and nation.',
                'speaker' => 'Pastor John Doe',
                'scripture_reference' => 'James 5:16-18',
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'video_embed_id' => 'dQw4w9WgXcQ',
                'status' => 'published',
                'is_featured' => true,
                'language' => 'en',
                'preached_date' => now()->subWeeks(2),
            ],
            [
                'title' => 'Faith That Moves Mountains',
                'description' => 'A powerful message on the kind of faith that activates the supernatural power of God in your life.',
                'speaker' => 'Guest Speaker',
                'scripture_reference' => 'Matthew 17:20',
                'video_type' => 'youtube',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'video_embed_id' => 'dQw4w9WgXcQ',
                'status' => 'published',
                'is_featured' => false,
                'language' => 'en',
                'preached_date' => now()->subWeeks(3),
            ],
            [
                'title' => 'God\'s Purpose for Cambodia',
                'description' => 'Understanding God\'s divine plan for Cambodia and our role as the Church to see the nation transformed.',
                'speaker' => 'Pastor John Doe',
                'scripture_reference' => 'Jeremiah 29:11',
                'status' => 'published',
                'is_featured' => false,
                'language' => 'both',
                'preached_date' => now()->subWeeks(4),
            ],
        ];

        foreach ($sermons as $sermonData) {
            Sermon::firstOrCreate(
                ['title' => $sermonData['title']],
                array_merge($sermonData, [
                    'category_id' => $category?->id,
                    'author_id' => $adminUser?->id,
                    'allow_download' => true,
                    'views' => rand(50, 500),
                    'published_at' => $sermonData['preached_date'],
                ])
            );
        }

        $this->command->info('✓ Sermons seeded (' . count($sermons) . ')');
    }
}
