<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'ROLCC Cambodia', 'type' => 'text', 'group' => 'general', 'label' => 'Site Name', 'is_public' => true, 'order' => 1],
            ['key' => 'site_tagline', 'value' => 'Transforming Lives, Impacting Nations', 'type' => 'text', 'group' => 'general', 'label' => 'Tagline', 'is_public' => true, 'order' => 2],
            ['key' => 'church_phone', 'value' => '+855 12 345 678', 'type' => 'text', 'group' => 'general', 'label' => 'Phone', 'is_public' => true, 'order' => 3],
            ['key' => 'church_email', 'value' => 'info@rolcccambodia.org', 'type' => 'text', 'group' => 'general', 'label' => 'Email', 'is_public' => true, 'order' => 4],
            ['key' => 'church_address', 'value' => 'Phnom Penh, Cambodia', 'type' => 'text', 'group' => 'general', 'label' => 'Address', 'is_public' => true, 'order' => 5],
            ['key' => 'google_maps_url', 'value' => '', 'type' => 'text', 'group' => 'general', 'label' => 'Google Maps URL', 'is_public' => true, 'order' => 6],
            ['key' => 'maintenance_mode', 'value' => '0', 'type' => 'boolean', 'group' => 'general', 'label' => 'Maintenance Mode', 'is_public' => false, 'order' => 7],

            // Branding
            ['key' => 'site_logo', 'value' => 'images/logo.png', 'type' => 'image', 'group' => 'branding', 'label' => 'Logo', 'is_public' => true, 'order' => 1],
            ['key' => 'site_favicon', 'value' => 'images/favicon.png', 'type' => 'image', 'group' => 'branding', 'label' => 'Favicon', 'is_public' => true, 'order' => 2],
            ['key' => 'primary_color', 'value' => '#145DA0', 'type' => 'color', 'group' => 'branding', 'label' => 'Primary Color', 'is_public' => true, 'order' => 3],
            ['key' => 'accent_color', 'value' => '#D4A017', 'type' => 'color', 'group' => 'branding', 'label' => 'Accent Color', 'is_public' => true, 'order' => 4],

            // Social
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/rolcccambodia', 'type' => 'text', 'group' => 'social', 'label' => 'Facebook URL', 'is_public' => true, 'order' => 1],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com/@rolcccambodia', 'type' => 'text', 'group' => 'social', 'label' => 'YouTube URL', 'is_public' => true, 'order' => 2],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/rolcccambodia', 'type' => 'text', 'group' => 'social', 'label' => 'Instagram URL', 'is_public' => true, 'order' => 3],
            ['key' => 'telegram_url', 'value' => 'https://t.me/rolcccambodia', 'type' => 'text', 'group' => 'social', 'label' => 'Telegram URL', 'is_public' => true, 'order' => 4],

            // SEO
            ['key' => 'meta_title', 'value' => 'ROLCC Cambodia — River of Life Christian Church', 'type' => 'text', 'group' => 'seo', 'label' => 'Default Meta Title', 'is_public' => false, 'order' => 1],
            ['key' => 'meta_description', 'value' => 'River of Life Christian Church Cambodia — Transforming Lives, Impacting Nations. Join us for worship in Phnom Penh.', 'type' => 'text', 'group' => 'seo', 'label' => 'Default Meta Description', 'is_public' => false, 'order' => 2],
            ['key' => 'google_analytics_id', 'value' => '', 'type' => 'text', 'group' => 'seo', 'label' => 'Google Analytics ID', 'is_public' => false, 'order' => 3],

            // Livestream
            ['key' => 'livestream_enabled', 'value' => '1', 'type' => 'boolean', 'group' => 'livestream', 'label' => 'Enable Livestream', 'is_public' => true, 'order' => 1],
            ['key' => 'youtube_channel_id', 'value' => '', 'type' => 'text', 'group' => 'livestream', 'label' => 'YouTube Channel ID', 'is_public' => false, 'order' => 2],
            ['key' => 'facebook_page_id', 'value' => '', 'type' => 'text', 'group' => 'livestream', 'label' => 'Facebook Page ID', 'is_public' => false, 'order' => 3],

            // Email
            ['key' => 'admin_notification_email', 'value' => 'admin@rolcccambodia.org', 'type' => 'text', 'group' => 'email', 'label' => 'Admin Notification Email', 'is_public' => false, 'order' => 1],
            ['key' => 'donation_notification_email', 'value' => 'finance@rolcccambodia.org', 'type' => 'text', 'group' => 'email', 'label' => 'Donation Notification Email', 'is_public' => false, 'order' => 2],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(['key' => $setting['key']], $setting);
        }

        $this->command->info('✓ Settings seeded');
    }
}
