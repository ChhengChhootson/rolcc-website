<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class TrackPageViews
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Track page views (only GET requests, not bots)
        if ($request->isMethod('GET') && !$this->isBot($request)) {
            $today = now()->format('Y-m-d');
            $key = "page_views_{$today}";
            Cache::increment($key);
            Cache::put($key, Cache::get($key, 0), now()->endOfDay());
        }

        return $response;
    }

    private function isBot(Request $request): bool
    {
        $userAgent = strtolower($request->userAgent() ?? '');
        $bots = ['bot', 'crawler', 'spider', 'scraper', 'crawl', 'facebookexternalhit'];
        foreach ($bots as $bot) {
            if (str_contains($userAgent, $bot)) return true;
        }
        return false;
    }
}
