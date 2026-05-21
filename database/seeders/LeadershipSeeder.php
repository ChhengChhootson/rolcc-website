<?php

namespace Database\Seeders;

use App\Models\Leadership;
use Illuminate\Database\Seeder;

class LeadershipSeeder extends Seeder
{
    public function run(): void
    {
        $leaders = [
            ['name' => 'Pastor John Doe', 'title' => 'Senior Pastor', 'title_km' => 'គ្រូបង្គោល', 'category' => 'senior', 'bio' => 'Pastor John has been leading ROLCC Cambodia since its founding. With over 20 years of ministry experience, he is passionate about seeing Cambodia transformed by the Gospel.', 'is_active' => true, 'is_featured' => true, 'order' => 1],
            ['name' => 'Pastor Jane Doe', 'title' => 'Associate Pastor', 'category' => 'associate', 'bio' => 'Pastor Jane oversees the women\'s ministry and pastoral care department. She has a heart for discipleship and spiritual growth.', 'is_active' => true, 'is_featured' => true, 'order' => 2],
            ['name' => 'Elder Michael Chen', 'title' => 'Elder', 'category' => 'elder', 'bio' => 'Elder Michael serves on the church board and oversees strategic planning and governance.', 'is_active' => true, 'is_featured' => false, 'order' => 3],
            ['name' => 'Elder Sarah Kim', 'title' => 'Elder', 'category' => 'elder', 'bio' => 'Elder Sarah leads the prayer ministry and intercession team.', 'is_active' => true, 'is_featured' => false, 'order' => 4],
            ['name' => 'Deacon David Lim', 'title' => 'Deacon', 'category' => 'deacon', 'bio' => 'Deacon David oversees the media and technology department.', 'is_active' => true, 'is_featured' => false, 'order' => 5],
        ];

        foreach ($leaders as $leader) {
            Leadership::firstOrCreate(['name' => $leader['name']], $leader);
        }

        $this->command->info('✓ Leadership team seeded');
    }
}
