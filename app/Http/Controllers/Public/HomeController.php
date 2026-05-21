<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ministry;
use App\Models\Sermon;
use App\Models\Testimonial;
use App\Models\Announcement;
use App\Models\Livestream;
use App\Services\SermonService;
use App\Services\EventService;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function __construct(
        private SermonService $sermonService,
        private EventService $eventService,
    ) {}

    public function index()
    {
        $data = Cache::remember('home_page_data', 900, function () {
            return [
                'featured_sermons' => $this->sermonService->getLatestSermons(4),
                'upcoming_events' => $this->eventService->getFeaturedEvents(3),
                'ministries' => Ministry::active()->featured()->orderBy('order')->limit(6)->get(),
                'testimonials' => Testimonial::approved()->featured()->orderBy('order')->limit(6)->get(),
                'announcements' => Announcement::where('is_active', true)
                    ->where(fn($q) => $q->whereNull('ends_at')->orWhere('ends_at', '>=', now()))
                    ->orderBy('order')
                    ->limit(3)
                    ->get(),
                'live_stream' => Livestream::live()->first(),
            ];
        });

        return view('public.home.index', $data);
    }

    public function about()
    {
        $data = [
            'leadership' => \App\Models\Leadership::active()->orderBy('order')->get()->groupBy('category'),
            'ministries' => Ministry::active()->orderBy('order')->get(),
        ];
        return view('public.about.index', $data);
    }

    public function contact()
    {
        return view('public.contact.index');
    }

    public function donate()
    {
        $categories = \App\Models\DonationCategory::where('is_active', true)->orderBy('order')->get();
        return view('public.donate.index', compact('categories'));
    }

    public function liveStream()
    {
        $liveStream = Livestream::live()->first();
        $scheduledStream = Livestream::scheduled()->first();
        $pastStreams = Livestream::where('status', 'ended')->orderByDesc('ended_at')->limit(10)->get();

        return view('public.home.livestream', compact('liveStream', 'scheduledStream', 'pastStreams'));
    }
}
