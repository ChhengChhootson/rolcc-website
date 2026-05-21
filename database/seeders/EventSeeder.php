<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('is_admin', true)->first();

        $events = [
            [
                'title' => 'ROLCC Annual Conference 2025',
                'slug' => 'rolcc-annual-conference-2025',
                'short_description' => 'Join us for our most anticipated conference of the year. Three days of worship, teaching, and powerful encounters with God.',
                'description' => '<p>The ROLCC Annual Conference 2025 is a time of spiritual renewal, powerful teaching, and community gathering. This year\'s theme is <strong>"Awakening: A New Season"</strong>.</p><p>Expect powerful worship, anointed speakers, and transformative encounters with God.</p>',
                'event_type' => 'conference',
                'start_date' => now()->addMonths(2)->setTime(9, 0),
                'end_date' => now()->addMonths(2)->addDays(2)->setTime(21, 0),
                'location' => 'ROLCC Cambodia Main Auditorium',
                'address' => 'Phnom Penh, Cambodia',
                'requires_registration' => true,
                'max_attendees' => 500,
                'ticket_price' => 0,
                'status' => 'published',
                'is_featured' => true,
            ],
            [
                'title' => 'Youth Night Live',
                'slug' => 'youth-night-live-2025',
                'short_description' => 'A night of dynamic worship, powerful ministry, and fellowship for young people.',
                'description' => '<p>Youth Night Live is our monthly gathering designed specifically for young people aged 13-30.</p>',
                'event_type' => 'youth',
                'start_date' => now()->addWeeks(2)->setTime(18, 30),
                'end_date' => now()->addWeeks(2)->setTime(21, 30),
                'location' => 'ROLCC Youth Hall',
                'requires_registration' => false,
                'ticket_price' => 0,
                'status' => 'published',
                'is_featured' => true,
            ],
            [
                'title' => 'All-Night Prayer Vigil',
                'slug' => 'all-night-prayer-vigil',
                'short_description' => 'A night dedicated to intercession for Cambodia and the nations.',
                'description' => '<p>Join us as we spend the night seeking God\'s face in prayer and worship for Cambodia, Southeast Asia, and the nations.</p>',
                'event_type' => 'prayer',
                'start_date' => now()->addWeeks(3)->setTime(22, 0),
                'end_date' => now()->addWeeks(3)->addDay()->setTime(6, 0),
                'location' => 'ROLCC Main Sanctuary',
                'requires_registration' => true,
                'ticket_price' => 0,
                'status' => 'published',
                'is_featured' => false,
            ],
            [
                'title' => 'Community Outreach Program',
                'slug' => 'community-outreach-2025',
                'short_description' => 'Serving our community with love — food distribution, medical aid, and evangelism.',
                'description' => '<p>ROLCC Community Outreach brings the love of Christ to vulnerable communities through practical service.</p>',
                'event_type' => 'outreach',
                'start_date' => now()->addMonth()->setTime(8, 0),
                'end_date' => now()->addMonth()->setTime(17, 0),
                'location' => 'Phnom Penh Community Center',
                'requires_registration' => true,
                'ticket_price' => 0,
                'status' => 'published',
                'is_featured' => false,
            ],
        ];

        foreach ($events as $eventData) {
            Event::firstOrCreate(
                ['slug' => $eventData['slug']],
                array_merge($eventData, [
                    'organizer_id' => $admin?->id,
                    'published_at' => now(),
                    'views' => rand(20, 200),
                ])
            );
        }

        $this->command->info('✓ Events seeded (' . count($events) . ')');
    }
}
