<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule jobs
Schedule::command('queue:prune-batches')->daily();
Schedule::command('cache:prune-stale-tags')->hourly();

// Update livestream status
Schedule::call(function () {
    // Auto-end livestreams that haven't been updated for 4+ hours
    \App\Models\Livestream::where('is_live', true)
        ->where('started_at', '<', now()->subHours(4))
        ->update(['is_live' => false, 'status' => 'ended', 'ended_at' => now()]);
})->hourly();
