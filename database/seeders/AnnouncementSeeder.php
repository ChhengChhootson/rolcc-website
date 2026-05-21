<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('is_admin', true)->first();

        Announcement::firstOrCreate(
            ['title' => 'Welcome to ROLCC Cambodia Online'],
            [
                'content' => '<p>Welcome to the new ROLCC Cambodia website! We\'re excited to share sermons, events, and resources with you online. God bless!</p>',
                'type' => 'general',
                'color' => '#145DA0',
                'show_banner' => true,
                'is_active' => true,
                'author_id' => $admin?->id,
                'order' => 1,
            ]
        );

        $this->command->info('✓ Announcements seeded');
    }
}
