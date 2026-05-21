<?php

return [
    'name' => env('CHURCH_NAME', 'River of Life Christian Church Cambodia'),
    'short_name' => 'ROLCC Cambodia',
    'tagline' => 'Transforming Lives, Impacting Nations',
    'phone' => env('CHURCH_PHONE', '+855 12 345 678'),
    'email' => env('CHURCH_EMAIL', 'info@rolcccambodia.org'),
    'address' => env('CHURCH_ADDRESS', 'Phnom Penh, Cambodia'),
    'city' => 'Phnom Penh',
    'country' => 'Cambodia',
    'timezone' => 'Asia/Phnom_Penh',
    'currency' => 'USD',
    'currency_symbol' => '$',

    'service_times' => [
        ['day' => 'Sunday', 'time' => '8:00 AM', 'name' => 'Morning Service'],
        ['day' => 'Sunday', 'time' => '10:30 AM', 'name' => 'Main Service'],
        ['day' => 'Wednesday', 'time' => '7:00 PM', 'name' => 'Midweek Service'],
        ['day' => 'Friday', 'time' => '7:00 PM', 'name' => 'Prayer Night'],
    ],

    'social' => [
        'facebook' => env('FACEBOOK_URL', 'https://facebook.com/rolcccambodia'),
        'youtube' => env('YOUTUBE_URL', 'https://youtube.com/@rolcccambodia'),
        'instagram' => env('INSTAGRAM_URL', 'https://instagram.com/rolcccambodia'),
        'telegram' => env('TELEGRAM_URL', 'https://t.me/rolcccambodia'),
    ],

    'colors' => [
        'primary' => '#145DA0',
        'secondary' => '#0B4F8C',
        'accent' => '#D4A017',
        'dark' => '#082032',
        'light' => '#F8FAFC',
    ],

    'logo' => [
        'path' => 'images/logo.png',
        'alt' => 'ROLCC Cambodia Logo',
        'width' => 180,
        'height' => 60,
    ],

    'founded_year' => 2000,
    'denomination' => 'Christian',
    'language' => ['km', 'en'],

    'livestream' => [
        'enabled' => true,
        'youtube_channel_id' => env('YOUTUBE_CHANNEL_ID', ''),
        'facebook_page_id' => env('FACEBOOK_PAGE_ID', ''),
    ],

    'analytics' => [
        'google_id' => env('GOOGLE_ANALYTICS_ID', ''),
    ],

    'recaptcha' => [
        'site_key' => env('RECAPTCHA_SITE_KEY', ''),
        'secret_key' => env('RECAPTCHA_SECRET_KEY', ''),
    ],

    'admin' => [
        'email' => env('ADMIN_EMAIL', 'admin@rolcccambodia.org'),
        'items_per_page' => 20,
    ],

    'media' => [
        'max_image_size' => 5120, // KB
        'max_video_size' => 102400, // KB
        'allowed_image_types' => ['jpg', 'jpeg', 'png', 'webp', 'gif'],
        'allowed_video_types' => ['mp4', 'mov', 'avi', 'webm'],
        'allowed_document_types' => ['pdf', 'doc', 'docx', 'pptx'],
        'thumbnail_sizes' => [
            'thumb' => [150, 150],
            'medium' => [600, 400],
            'large' => [1200, 800],
        ],
    ],
];
