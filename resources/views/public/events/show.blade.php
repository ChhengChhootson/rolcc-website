@extends('layouts.app')

@section('title', $event->title . ' — ROLCC Cambodia')
@section('description', Str::limit($event->excerpt ?? $event->description, 160))

@section('content')

<section class="py-20" style="background: linear-gradient(135deg, #082032 0%, #0B4F8C 100%);">
    <div class="container mx-auto px-4 text-center">
        <p class="text-yellow-400 text-sm font-semibold uppercase tracking-widest mb-3">EVENT</p>
        <h1 class="text-4xl md:text-5xl font-bold text-white max-w-3xl mx-auto" style="font-family: Poppins">{{ $event->title }}</h1>
        <div class="flex items-center justify-center gap-6 mt-6 text-blue-200 text-sm flex-wrap">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                {{ $event->start_date->format('l, F j, Y') }}
            </span>
            @if($event->location)
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                {{ $event->location }}
            </span>
            @endif
        </div>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-10 max-w-6xl mx-auto">
            {{-- Main Content --}}
            <div class="lg:col-span-2">
                @if($event->thumbnail)
                <div class="rounded-2xl overflow-hidden mb-8 shadow-lg">
                    <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="{{ $event->title }}" class="w-full">
                </div>
                @endif

                <div class="prose prose-lg max-w-none text-gray-700">
                    {!! $event->description !!}
                </div>

                @if(isset($relatedEvents) && $relatedEvents->count())
                <div class="mt-12">
                    <h3 class="text-xl font-bold text-gray-900 mb-6" style="font-family: Poppins">More Events</h3>
                    <div class="grid sm:grid-cols-2 gap-4">
                        @foreach($relatedEvents as $related)
                        <a href="{{ route('events.show', $related->slug) }}" class="p-4 border border-gray-200 rounded-xl hover:border-blue-300 hover:shadow-md transition-all group">
                            <div class="text-blue-600 text-sm font-medium mb-1">{{ $related->start_date->format('M j, Y') }}</div>
                            <div class="font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">{{ $related->title }}</div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div>
                <div class="bg-gray-50 rounded-2xl p-6 sticky top-24">
                    <h3 class="font-bold text-gray-900 mb-5" style="font-family: Poppins">Event Details</h3>
                    <div class="space-y-4 text-sm">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <div>
                                <div class="font-medium text-gray-700">Date & Time</div>
                                <div class="text-gray-500">{{ $event->start_date->format('l, F j, Y') }}</div>
                                <div class="text-gray-500">{{ $event->start_date->format('g:i A') }}@if($event->end_date) – {{ $event->end_date->format('g:i A') }}@endif</div>
                            </div>
                        </div>
                        @if($event->location)
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            <div>
                                <div class="font-medium text-gray-700">Location</div>
                                <div class="text-gray-500">{{ $event->location }}</div>
                            </div>
                        </div>
                        @endif
                        @if($event->is_free)
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div><span class="font-medium text-green-600">Free Event</span></div>
                        </div>
                        @endif
                    </div>

                    @if($event->requires_registration && !$event->isFull())
                    <div class="mt-6">
                        <a href="{{ route('events.register', $event->slug) }}" class="block w-full text-center py-3 px-6 font-bold text-white rounded-xl transition-all hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">
                            Register Now
                        </a>
                        @if($event->available_spots !== null)
                            <p class="text-center text-xs text-gray-500 mt-2">{{ $event->available_spots }} spots remaining</p>
                        @endif
                    </div>
                    @elseif($event->requires_registration && $event->isFull())
                    <div class="mt-6">
                        <div class="w-full text-center py-3 px-6 font-bold text-gray-500 rounded-xl bg-gray-200">
                            Event Full
                        </div>
                    </div>
                    @endif

                    <div class="mt-5 flex gap-3">
                        <a href="{{ route('events.index') }}" class="flex-1 text-center py-2.5 border border-blue-200 text-blue-700 font-medium rounded-xl hover:bg-blue-50 transition-colors text-sm">
                            All Events
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
