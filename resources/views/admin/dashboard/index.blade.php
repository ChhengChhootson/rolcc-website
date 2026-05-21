@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-heading font-bold text-gray-900">
                Good {{ now()->hour < 12 ? 'Morning' : (now()->hour < 17 ? 'Afternoon' : 'Evening') }}, {{ auth()->user()->name }} 👋
            </h1>
            <p class="text-gray-500 mt-1 text-sm">{{ now()->format('l, F d, Y') }} • ROLCC Cambodia Admin Panel</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.sermons.create') }}" class="admin-btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Sermon
            </a>
            <a href="{{ route('admin.events.create') }}" class="admin-btn-secondary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Event
            </a>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="admin-stat-card bg-gradient-to-br from-church-blue to-royal-blue text-white">
            <div class="flex items-center justify-between mb-3">
                <span class="text-blue-200 text-sm font-medium">Total Sermons</span>
                <div class="w-9 h-9 bg-white/15 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.868v6.264a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </div>
            </div>
            <div class="text-3xl font-bold">{{ number_format($stats['total_sermons']) }}</div>
            <div class="text-blue-200 text-xs mt-1">Published sermons</div>
        </div>

        <div class="admin-stat-card bg-gradient-to-br from-church-gold to-amber-500 text-dark-navy">
            <div class="flex items-center justify-between mb-3">
                <span class="text-amber-800 text-sm font-medium">This Month's Giving</span>
                <div class="w-9 h-9 bg-dark-navy/10 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="text-3xl font-bold">${{ number_format($stats['total_donations_this_month'], 2) }}</div>
            <div class="text-amber-800 text-xs mt-1">{{ $stats['total_donations_count_this_month'] }} donations</div>
        </div>

        <div class="admin-stat-card bg-white border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <span class="text-gray-500 text-sm font-medium">Upcoming Events</span>
                <div class="w-9 h-9 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-gray-900">{{ number_format($stats['upcoming_events']) }}</div>
            <div class="text-gray-400 text-xs mt-1">Scheduled events</div>
        </div>

        <div class="admin-stat-card bg-white border border-gray-100 shadow-sm relative">
            @if($stats['urgent_prayer_requests'] > 0)
            <div class="absolute top-3 right-3 w-2.5 h-2.5 bg-red-500 rounded-full animate-ping"></div>
            @endif
            <div class="flex items-center justify-between mb-3">
                <span class="text-gray-500 text-sm font-medium">Prayer Requests</span>
                <div class="w-9 h-9 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
            </div>
            <div class="text-3xl font-bold text-gray-900">{{ number_format($stats['pending_prayer_requests']) }}</div>
            <div class="flex items-center gap-2 mt-1">
                <div class="text-gray-400 text-xs">Pending</div>
                @if($stats['urgent_prayer_requests'] > 0)
                <span class="bg-red-100 text-red-600 text-xs px-1.5 py-0.5 rounded font-medium">{{ $stats['urgent_prayer_requests'] }} urgent</span>
                @endif
            </div>
        </div>
    </div>

    {{-- Second row --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="admin-stat-card bg-white border border-gray-100 shadow-sm">
            <div class="text-gray-500 text-sm mb-2">Newsletter Subscribers</div>
            <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['newsletter_subscribers']) }}</div>
        </div>
        <div class="admin-stat-card bg-white border border-gray-100 shadow-sm">
            <div class="text-gray-500 text-sm mb-2">Unread Messages</div>
            <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['unread_messages']) }}</div>
        </div>
        <div class="admin-stat-card bg-white border border-gray-100 shadow-sm">
            <div class="text-gray-500 text-sm mb-2">Total Users</div>
            <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_users']) }}</div>
            <div class="text-xs text-green-500 mt-1">+{{ $stats['new_users_this_month'] }} this month</div>
        </div>
        <div class="admin-stat-card bg-white border border-gray-100 shadow-sm">
            <div class="text-gray-500 text-sm mb-2">Event Registrations</div>
            <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_event_registrations']) }}</div>
        </div>
    </div>

    {{-- Charts + Activity --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Donation Chart --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-heading font-semibold text-gray-900">Donations — {{ date('Y') }}</h3>
                <span class="text-xs text-gray-400">Monthly Overview</span>
            </div>
            <div class="h-56">
                <canvas id="donationsChart"></canvas>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h3 class="font-heading font-semibold text-gray-900 mb-4">Quick Actions</h3>
            <div class="space-y-2.5">
                <a href="{{ route('admin.sermons.create') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                    <div class="w-9 h-9 bg-church-blue/10 group-hover:bg-church-blue rounded-lg flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-church-blue group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Add New Sermon</span>
                </a>
                <a href="{{ route('admin.events.create') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                    <div class="w-9 h-9 bg-green-100 group-hover:bg-green-500 rounded-lg flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-green-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Create Event</span>
                </a>
                <a href="{{ route('admin.prayers.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                    <div class="w-9 h-9 bg-red-100 group-hover:bg-red-500 rounded-lg flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-red-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Review Prayers</span>
                    @if($stats['pending_prayer_requests'] > 0)
                    <span class="ml-auto bg-red-100 text-red-600 text-xs px-2 py-0.5 rounded-full font-medium">{{ $stats['pending_prayer_requests'] }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.media.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                    <div class="w-9 h-9 bg-purple-100 group-hover:bg-purple-500 rounded-lg flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-purple-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Upload Media</span>
                </a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                    <div class="w-9 h-9 bg-gray-100 group-hover:bg-gray-600 rounded-lg flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-gray-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <span class="text-sm font-medium text-gray-700">Site Settings</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Recent Data --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Recent Donations --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between p-5 border-b border-gray-100">
                <h3 class="font-heading font-semibold text-gray-900">Recent Donations</h3>
                <a href="{{ route('admin.donations.index') }}" class="text-xs text-church-blue hover:underline">View all →</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($recentDonations as $donation)
                <div class="flex items-center justify-between px-5 py-3.5">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-church-gold/10 flex items-center justify-center text-church-gold font-bold text-xs">
                            {{ strtoupper(substr($donation->donor_display_name, 0, 2)) }}
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ $donation->donor_display_name }}</div>
                            <div class="text-xs text-gray-400">{{ $donation->donated_at->diffForHumans() }} • {{ $donation->payment_method }}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-bold text-green-600 text-sm">{{ $donation->amount_formatted }}</div>
                        @if($donation->category)
                        <div class="text-xs text-gray-400">{{ $donation->category->name }}</div>
                        @endif
                    </div>
                </div>
                @empty
                <div class="px-5 py-8 text-center text-gray-400 text-sm">No donations yet</div>
                @endforelse
            </div>
        </div>

        {{-- Upcoming Events --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between p-5 border-b border-gray-100">
                <h3 class="font-heading font-semibold text-gray-900">Upcoming Events</h3>
                <a href="{{ route('admin.events.index') }}" class="text-xs text-church-blue hover:underline">View all →</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($upcomingEvents as $event)
                <div class="flex items-center gap-4 px-5 py-3.5">
                    <div class="w-12 h-12 bg-church-blue/10 rounded-xl flex flex-col items-center justify-center flex-shrink-0">
                        <div class="text-church-blue font-bold text-sm leading-none">{{ $event->start_date->format('d') }}</div>
                        <div class="text-church-blue/70 text-xs">{{ $event->start_date->format('M') }}</div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-medium text-gray-900 text-sm truncate">{{ $event->title }}</div>
                        <div class="text-xs text-gray-400 mt-0.5">{{ $event->start_date->format('g:i A') }} • {{ $event->location ?? 'TBD' }}</div>
                    </div>
                    <div class="flex-shrink-0">
                        <span class="text-xs px-2 py-1 rounded-full font-medium
                            {{ $event->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($event->status) }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="px-5 py-8 text-center text-gray-400 text-sm">No upcoming events</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Urgent Prayer Requests --}}
    @if($recentPrayers->count())
    <div class="bg-white rounded-2xl border border-red-100 shadow-sm overflow-hidden">
        <div class="flex items-center gap-3 p-5 border-b border-red-100 bg-red-50/50">
            <div class="w-2 h-2 bg-red-500 rounded-full animate-ping"></div>
            <h3 class="font-heading font-semibold text-gray-900">Pending Prayer Requests</h3>
            <span class="ml-auto bg-red-100 text-red-600 text-xs px-2 py-0.5 rounded-full font-bold">{{ $stats['pending_prayer_requests'] }}</span>
        </div>
        <div class="divide-y divide-gray-50">
            @foreach($recentPrayers->take(3) as $prayer)
            <div class="flex items-start gap-4 px-5 py-4">
                <div class="flex-shrink-0 mt-0.5">
                    @if($prayer->is_urgent)
                    <span class="w-2 h-2 bg-red-500 rounded-full block"></span>
                    @else
                    <span class="w-2 h-2 bg-gray-300 rounded-full block"></span>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="font-medium text-sm text-gray-900">{{ $prayer->requester_name }}</span>
                        <span class="text-xs text-gray-400">{{ $prayer->created_at->diffForHumans() }}</span>
                        @if($prayer->is_urgent)
                        <span class="bg-red-100 text-red-600 text-xs px-1.5 py-0.5 rounded font-medium">Urgent</span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-500 line-clamp-2">{{ $prayer->request }}</p>
                </div>
                <a href="{{ route('admin.prayers.show', $prayer) }}" class="flex-shrink-0 text-xs text-church-blue hover:underline">Review</a>
            </div>
            @endforeach
        </div>
        <div class="p-4 border-t border-gray-100 bg-gray-50/50">
            <a href="{{ route('admin.prayers.index') }}" class="text-sm text-church-blue hover:underline font-medium">View all {{ $stats['pending_prayer_requests'] }} pending requests →</a>
        </div>
    </div>
    @endif

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
<script>
const ctx = document.getElementById('donationsChart');
if (ctx) {
    const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    const data = @json($donationsByMonth);
    const chartData = months.map((_, i) => data[i + 1] || 0);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Donations ($)',
                data: chartData,
                backgroundColor: 'rgba(20, 93, 160, 0.8)',
                borderRadius: 8,
                borderSkipped: false,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.05)' },
                    ticks: {
                        callback: (val) => '$' + val.toLocaleString(),
                        font: { size: 11 },
                    },
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11 } },
                },
            },
        },
    });
}
</script>
@endpush
