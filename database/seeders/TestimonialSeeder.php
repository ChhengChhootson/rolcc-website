<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            ['name' => 'Sophea Chann', 'title' => 'Church Member', 'content' => 'ROLCC Cambodia has completely transformed my life. The community here is like family, and the teachings have deepened my faith in ways I never thought possible. God is truly moving here!', 'rating' => 5, 'is_featured' => true, 'is_approved' => true, 'status' => 'approved', 'category' => 'salvation', 'order' => 1],
            ['name' => 'David Nguyen', 'title' => 'Youth Member', 'content' => 'The Youth Ministry changed everything for me. I found my purpose and a community of friends who genuinely care. Pastor John\'s sermons are life-changing!', 'rating' => 5, 'is_featured' => true, 'is_approved' => true, 'status' => 'approved', 'category' => 'general', 'order' => 2],
            ['name' => 'Mary Johnson', 'title' => 'International Member', 'content' => 'As an expat in Cambodia, I was looking for a church home. ROLCC welcomed me with open arms. The English Ministry is wonderful and the worship is incredible.', 'rating' => 5, 'is_featured' => true, 'is_approved' => true, 'status' => 'approved', 'category' => 'general', 'order' => 3],
            ['name' => 'Dara Sok', 'title' => 'Family Member', 'content' => 'My family was going through a very difficult season. The prayer team at ROLCC prayed with us and God performed a miracle. We are so grateful for this church.', 'rating' => 5, 'is_featured' => true, 'is_approved' => true, 'status' => 'approved', 'category' => 'healing', 'order' => 4],
            ['name' => 'Lisa Park', 'title' => 'New Believer', 'content' => 'I came to ROLCC not knowing anything about Christianity. The welcoming atmosphere and clear biblical teaching led me to give my life to Jesus. Best decision ever!', 'rating' => 5, 'is_featured' => true, 'is_approved' => true, 'status' => 'approved', 'category' => 'salvation', 'order' => 5],
            ['name' => 'James Wilson', 'title' => 'Ministry Leader', 'content' => 'Serving in worship ministry at ROLCC has been the most fulfilling thing I\'ve ever done. The passion for God here is contagious and the community is exceptional.', 'rating' => 5, 'is_featured' => false, 'is_approved' => true, 'status' => 'approved', 'category' => 'general', 'order' => 6],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::firstOrCreate(['name' => $testimonial['name']], $testimonial);
        }

        $this->command->info('✓ Testimonials seeded');
    }
}
