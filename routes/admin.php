<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SermonController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\MinistryController;
use App\Http\Controllers\Admin\PrayerRequestController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\LeadershipController;
use App\Http\Controllers\Admin\TestimonialController;

use App\Http\Controllers\Admin\AnnouncementController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Sermons
        Route::resource('sermons', SermonController::class);
        Route::post('sermons/{sermon}/toggle-featured', [SermonController::class, 'toggleFeatured'])->name('sermons.toggle-featured');
        Route::resource('sermon-categories', \App\Http\Controllers\Admin\SermonCategoryController::class);

        // Events
        Route::resource('events', EventController::class);
        Route::get('events/{event}/registrations', [EventController::class, 'registrations'])->name('events.registrations');
        Route::post('events/{event}/registrations/{registration}/check-in', [EventController::class, 'checkIn'])->name('events.check-in');
        Route::get('events/{event}/registrations/export', [EventController::class, 'exportRegistrations'])->name('events.registrations.export');

        // Ministries
        Route::resource('ministries', MinistryController::class);
        Route::post('ministries/reorder', [MinistryController::class, 'reorder'])->name('ministries.reorder');

        // Gallery
        Route::resource('albums', \App\Http\Controllers\Admin\AlbumController::class);
        Route::post('albums/{album}/upload', [\App\Http\Controllers\Admin\AlbumController::class, 'upload'])->name('albums.upload');
        Route::delete('gallery/{gallery}', [\App\Http\Controllers\Admin\AlbumController::class, 'destroyMedia'])->name('gallery.destroy');

        // Blog
        Route::resource('blogs', BlogController::class);
        Route::resource('blog-categories', \App\Http\Controllers\Admin\BlogCategoryController::class);

        // Donations
        Route::get('donations/export', [DonationController::class, 'export'])->name('donations.export');
        Route::resource('donations', DonationController::class)->only(['index', 'show', 'destroy']);
        Route::resource('donation-categories', \App\Http\Controllers\Admin\DonationCategoryController::class);

        // Prayer Requests
        Route::resource('prayers', PrayerRequestController::class)->only(['index', 'show', 'update', 'destroy']);

        // Leadership
        Route::resource('leadership', LeadershipController::class);
        Route::post('leadership/reorder', [LeadershipController::class, 'reorder'])->name('leadership.reorder');

        // Testimonials
        Route::resource('testimonials', TestimonialController::class);
        Route::post('testimonials/{testimonial}/approve', [TestimonialController::class, 'approve'])->name('testimonials.approve');
        Route::post('testimonials/{testimonial}/toggle-featured', [TestimonialController::class, 'toggleFeatured'])->name('testimonials.toggle-featured');

        // Announcements
        Route::resource('announcements', AnnouncementController::class);

        // Media Library
        Route::get('media', [MediaController::class, 'index'])->name('media.index');
        Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
        Route::delete('media/{mediaFile}', [MediaController::class, 'destroy'])->name('media.destroy');

        // Users & Roles
        Route::resource('users', UserController::class);
        Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
        Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);

        // Settings
        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::get('settings/branding', [SettingsController::class, 'branding'])->name('settings.branding');
        Route::get('settings/social', [SettingsController::class, 'social'])->name('settings.social');
        Route::get('settings/seo', [SettingsController::class, 'seo'])->name('settings.seo');
        Route::get('settings/livestream', [SettingsController::class, 'livestream'])->name('settings.livestream');

        // Activity Logs
        Route::get('activity-logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('activity-logs.index');
    });
