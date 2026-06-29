<?php

use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\SermonController;
use App\Http\Controllers\Public\EventController;
use App\Http\Controllers\Public\MinistryController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\PrayerRequestController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\BlogController;

use Illuminate\Support\Facades\Route;

// ============================================================
// PUBLIC ROUTES
// ============================================================

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/give', [HomeController::class, 'donate'])->name('donate');
Route::get('/live', [HomeController::class, 'liveStream'])->name('livestream');

// Sermons
Route::prefix('sermons')->name('sermons.')->group(function () {
    Route::get('/', [SermonController::class, 'index'])->name('index');
    Route::get('/{slug}', [SermonController::class, 'show'])->name('show');
    Route::get('/{slug}/download', [SermonController::class, 'download'])->name('download');
});

// Events
Route::prefix('events')->name('events.')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/calendar', [EventController::class, 'calendar'])->name('calendar');
    Route::get('/calendar/feed', [EventController::class, 'calendarFeed'])->name('calendar.feed');
    Route::get('/{slug}', [EventController::class, 'show'])->name('show');
    Route::post('/{slug}/register', [EventController::class, 'register'])->name('register');
    Route::get('/registration/{ticket}', [EventController::class, 'registrationSuccess'])->name('registration.success');
});

// Ministries
Route::prefix('ministries')->name('ministries.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Public\MinistryController::class, 'index'])->name('index');
    Route::get('/{slug}', [\App\Http\Controllers\Public\MinistryController::class, 'show'])->name('show');
});

// Gallery
Route::prefix('gallery')->name('gallery.')->group(function () {
    Route::get('/', [GalleryController::class, 'index'])->name('index');
    Route::get('/{slug}', [GalleryController::class, 'show'])->name('show');
});

// Prayer
Route::prefix('prayer')->name('prayer.')->group(function () {
    Route::get('/', [PrayerRequestController::class, 'index'])->name('index');
    Route::post('/submit', [PrayerRequestController::class, 'store'])->name('store')->middleware('throttle:5,1');
    Route::post('/{id}/pray', [PrayerRequestController::class, 'incrementPrayer'])->name('pray');
});

// Blog
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

// Auth Routes (Breeze)
require __DIR__ . '/auth.php';
