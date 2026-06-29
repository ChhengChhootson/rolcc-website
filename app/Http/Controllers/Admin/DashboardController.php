<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use App\Models\Event;
use App\Models\Donation;
use App\Models\PrayerRequest;
use App\Models\EventRegistration;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = Cache::remember('admin_dashboard_stats', 300, function () {
            $now = now();
            $monthStart = $now->startOfMonth()->copy();

            return [
                'total_sermons' => Sermon::count(),
                'total_events' => Event::count(),
                'upcoming_events' => Event::published()->upcoming()->count(),
                'total_donations_this_month' => Donation::completed()->thisMonth()->sum('amount'),
                'total_donations_count_this_month' => Donation::completed()->thisMonth()->count(),
                'pending_prayer_requests' => PrayerRequest::pending()->count(),
                'urgent_prayer_requests' => PrayerRequest::urgent()->where('status', 'pending')->count(),
                'unread_messages' => ContactMessage::where('status', 'unread')->count(),
                'total_users' => User::count(),
                'new_users_this_month' => User::whereMonth('created_at', $now->month)->count(),
                'total_event_registrations' => EventRegistration::count(),
            ];
        });

        $recentDonations = Donation::completed()
            ->with('category')
            ->orderByDesc('donated_at')
            ->limit(5)
            ->get();

        $recentPrayers = PrayerRequest::pending()
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        $upcomingEvents = Event::published()->upcoming()
            ->orderBy('start_date')
            ->limit(5)
            ->get();

        $donationsByMonth = Cache::remember('donations_by_month', 3600, function () {
            return Donation::completed()
                ->selectRaw('MONTH(donated_at) as month, SUM(amount) as total')
                ->whereYear('donated_at', now()->year)
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('total', 'month')
                ->toArray();
        });

        return view('admin.dashboard.index', compact(
            'stats', 'recentDonations', 'recentPrayers', 'upcomingEvents', 'donationsByMonth'
        ));
    }
}
