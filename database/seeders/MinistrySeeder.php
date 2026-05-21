<?php

namespace Database\Seeders;

use App\Models\Ministry;
use App\Models\MinistryLeader;
use Illuminate\Database\Seeder;

class MinistrySeeder extends Seeder
{
    public function run(): void
    {
        $ministries = [
            [
                'name' => 'Youth Ministry',
                'name_km' => 'ក្រុមយុវវ័យ',
                'slug' => 'youth-ministry',
                'short_description' => 'Empowering the next generation through faith, community, and purpose.',
                'description' => 'Our Youth Ministry is a vibrant community dedicated to helping young people aged 13-25 discover their identity in Christ. We offer weekly gatherings, camps, retreats, and discipleship programs.',
                'icon' => '🔥',
                'color' => '#145DA0',
                'age_group' => 'Youth (13-25)',
                'is_active' => true,
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'name' => 'Kids Ministry',
                'name_km' => 'ក្រុមកុមារ',
                'slug' => 'kids-ministry',
                'short_description' => 'Nurturing children in the love and knowledge of God.',
                'description' => 'Kids Ministry provides a safe, fun, and engaging environment for children ages 3-12. We teach biblical values through creative activities, worship, and age-appropriate Bible lessons.',
                'icon' => '⭐',
                'color' => '#F59E0B',
                'age_group' => 'Children (3-12)',
                'is_active' => true,
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'name' => 'Worship Ministry',
                'name_km' => 'ក្រុមថ្វាយបង្គំ',
                'slug' => 'worship-ministry',
                'short_description' => 'Leading the church into the presence of God through music and praise.',
                'description' => 'Our Worship Ministry team is passionate about creating an atmosphere of genuine worship. We serve in Sunday services, special events, and lead the congregation into encounters with God.',
                'icon' => '🎵',
                'color' => '#0B4F8C',
                'age_group' => 'All Ages',
                'is_active' => true,
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'name' => 'Prayer Ministry',
                'name_km' => 'ក្រុមអធិស្ឋាន',
                'slug' => 'prayer-ministry',
                'short_description' => 'Interceding for individuals, families, the church, and the nation.',
                'description' => 'The Prayer Ministry is the spiritual backbone of ROLCC Cambodia. We organize prayer nights, intercessory teams, and are committed to covering our community in prayer 24/7.',
                'icon' => '🙏',
                'color' => '#3C8DDB',
                'age_group' => 'All Ages',
                'is_active' => true,
                'is_featured' => true,
                'order' => 4,
            ],
            [
                'name' => 'Sport Ministry',
                'name_km' => 'ក្រុមកីឡា',
                'slug' => 'sport-ministry',
                'short_description' => 'Building community through sports and active lifestyle.',
                'description' => 'Sport Ministry uses athletics as a platform for evangelism and discipleship. We host tournaments, training sessions, and outreach events that connect people with the church community.',
                'icon' => '⚽',
                'color' => '#22C55E',
                'age_group' => 'Youth & Adults',
                'is_active' => true,
                'is_featured' => true,
                'order' => 5,
            ],
            [
                'name' => 'Media Ministry',
                'name_km' => 'ក្រុមមេឌៀ',
                'slug' => 'media-ministry',
                'short_description' => 'Communicating the Gospel through creative media and technology.',
                'description' => 'Our Media Ministry team handles all audio/visual production, live streaming, social media, graphic design, and photography/videography for the church and its events.',
                'icon' => '📸',
                'color' => '#8B5CF6',
                'age_group' => 'All Ages',
                'is_active' => true,
                'is_featured' => true,
                'order' => 6,
            ],
            [
                'name' => 'English Ministry',
                'name_km' => 'ក្រុមភាសាអង់គ្លេស',
                'slug' => 'english-ministry',
                'short_description' => 'Serving the international community in Phnom Penh.',
                'description' => 'English Ministry is a welcoming community for English-speaking members, expats, and internationals living in Cambodia. Services are conducted in English with translation available.',
                'icon' => '🌍',
                'color' => '#D4A017',
                'age_group' => 'All Ages',
                'is_active' => true,
                'is_featured' => false,
                'order' => 7,
            ],
        ];

        foreach ($ministries as $ministryData) {
            $ministry = Ministry::firstOrCreate(
                ['slug' => $ministryData['slug']],
                $ministryData
            );

            // Create a default leader for each ministry
            MinistryLeader::firstOrCreate(
                ['ministry_id' => $ministry->id, 'name' => 'Ministry Leader'],
                [
                    'title' => 'Ministry Director',
                    'bio' => 'Passionate leader serving in ' . $ministry->name,
                    'is_primary' => true,
                    'order' => 0,
                ]
            );
        }

        $this->command->info('✓ Ministries seeded (' . count($ministries) . ' ministries)');
    }
}
