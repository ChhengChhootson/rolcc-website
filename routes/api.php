<?php

use App\Http\Controllers\Api\SermonApiController;
use App\Http\Controllers\Api\EventApiController;
use App\Http\Controllers\Api\MinistryApiController;
use Illuminate\Support\Facades\Route;

// Public API (no auth required)
Route::prefix('v1')->name('api.v1.')->group(function () {

    // Sermons
    Route::prefix('sermons')->name('sermons.')->group(function () {
        Route::get('/', [SermonApiController::class, 'index'])->name('index');
        Route::get('/{slug}', [SermonApiController::class, 'show'])->name('show');
        Route::get('/categories', [SermonApiController::class, 'categories'])->name('categories');
    });

    // Events
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/', [EventApiController::class, 'index'])->name('index');
        Route::get('/upcoming', [EventApiController::class, 'upcoming'])->name('upcoming');
        Route::get('/{slug}', [EventApiController::class, 'show'])->name('show');
    });

    // Ministries
    Route::prefix('ministries')->name('ministries.')->group(function () {
        Route::get('/', [MinistryApiController::class, 'index'])->name('index');
        Route::get('/{slug}', [MinistryApiController::class, 'show'])->name('show');
    });

    // Settings (public)
    Route::get('/settings', function () {
        $settings = \App\Models\Setting::where('is_public', true)->get()
            ->mapWithKeys(fn($s) => [$s->key => $s->getParsedValue()]);
        return response()->json($settings);
    })->name('settings');

    // Live stream status
    Route::get('/livestream/status', function () {
        $live = \App\Models\Livestream::live()->first();
        return response()->json([
            'is_live' => (bool) $live,
            'stream' => $live,
        ]);
    })->name('livestream.status');
});

// Protected API (requires auth)
Route::middleware('auth:sanctum')->prefix('v1')->name('api.v1.auth.')->group(function () {
    Route::post('/prayer-requests', [\App\Http\Controllers\Api\PrayerApiController::class, 'store'])->name('prayer.store');
    Route::post('/newsletter/subscribe', [\App\Http\Controllers\Api\NewsletterApiController::class, 'subscribe'])->name('newsletter.subscribe');
    Route::get('/user', fn() => auth()->user())->name('user');
});
