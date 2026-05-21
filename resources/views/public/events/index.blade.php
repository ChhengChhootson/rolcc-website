@extends('layouts.app')

@section('title', 'Events — ROLCC Cambodia')
@section('description', 'Upcoming events at River of Life Christian Church Cambodia. Join us for worship, community, and ministry.')

@section('content')

<section class="py-20" style="background: linear-gradient(135deg, #082032 0%, #0B4F8C 100%);">
    <div class="container mx-auto px-4 text-center">
        <p class="text-yellow-400 text-sm font-semibold uppercase tracking-widest mb-3">CALENDAR</p>
        <h1 class="text-4xl md:text-5xl font-bold text-white" style="font-family: Poppins">Upcoming Events</h1>
        <p class="text-blue-200 text-lg mt-4 max-w-xl mx-auto">Join us for life-changing gatherings, celebrations, and community activities.</p>
    </div>
</section>

@if(isset($featuredEvents) && $featuredEvents->count())
<section class="py-14 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-gray-900" style="font-family: Poppins">Featured Events</h2>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @foreach($featuredEvents as $event)
            <a href="{{ route('events.show', $event->slug) }}" class="group block bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="relative h-48 overflow-hidden">
                    @if($event->thumbnail)
                        <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center" style="background: linear-gradient(135deg, #0B4F8C, #3C8DDB)">
                            <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    <span class="absolute top-3 left-3 px-3 py-1 text-xs font-bold text-white rounded-full" style="background: #D4A017">Featured</span>
                </div>
                <div class="p-5">
                    <div class="flex items-center gap-2 text-blue-600 text-sm font-medium mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $event->start_date->format('M j, Y') }}
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-2 group-hover:text-blue-700 transition-colors" style="font-family: Poppins">{{ $event->title }}</h3>
                    <p class="text-gray-500 text-sm">{{ Str::limit($event->excerpt ?? $event->description, 90) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="py-14" style="background: #f8faff;">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-gray-900" style="font-family: Poppins">All Upcoming Events</h2>
        </div>

        @if($events->count())
        <div class="max-w-4xl mx-auto space-y-4">
            @foreach($events as $event)
            <a href="{{ route('events.show', $event->slug) }}" class="group flex gap-5 bg-white rounded-2xl p-5 shadow-sm border border-gray-100 hover:shadow-lg hover:border-blue-200 transition-all duration-200">
                <div class="flex-shrink-0 w-16 h-16 rounded-xl flex flex-col items-center justify-center text-white font-bold" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">
                    <span class="text-lg leading-none">{{ $event->start_date->format('d') }}</span>
                    <span class="text-xs uppercase">{{ $event->start_date->format('M') }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-bold text-gray-900 group-hover:text-blue-700 transition-colors" style="font-family: Poppins">{{ $event->title }}</h3>
                    <div class="flex flex-wrap items-center gap-4 mt-1 text-sm text-gray-500">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $event->start_date->format('g:i A') }}
                        </span>
                        @if($event->location)
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            {{ $event->location }}
                        </span>
                        @endif
                        @if($event->requires_registration)
                        <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full text-xs font-medium">RSVP Required</span>
                        @endif
                    </div>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 flex-shrink-0 self-center transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
            @endforeach
        </div>
        {{ $events->links() }}
        @else
        <div class="text-center py-16">
            <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <p class="text-gray-500 text-lg">No upcoming events at this time.</p>
            <p class="text-gray-400 text-sm mt-1">Check back soon for new events!</p>
        </div>
        @endif
    </div>
</section>

@endsection
