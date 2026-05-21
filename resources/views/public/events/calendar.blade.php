@extends('layouts.app')
@section('title', 'Events Calendar — ROLCC Cambodia')
@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900" style="font-family: Poppins">Events Calendar</h1>
        </div>
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <a href="{{ route('events.calendar', ['month' => $month == 1 ? 12 : $month - 1, 'year' => $month == 1 ? $year - 1 : $year]) }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50 transition-colors">&larr; Prev</a>
                <h2 class="text-xl font-bold">{{ \Carbon\Carbon::create($year, $month)->format('F Y') }}</h2>
                <a href="{{ route('events.calendar', ['month' => $month == 12 ? 1 : $month + 1, 'year' => $month == 12 ? $year + 1 : $year]) }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50 transition-colors">Next &rarr;</a>
            </div>
            <div class="space-y-3">
                @forelse($events as $event)
                <a href="{{ route('events.show', $event->slug) }}" class="flex gap-4 p-4 border border-gray-200 rounded-xl hover:border-blue-300 hover:shadow-md transition-all group">
                    <div class="w-14 h-14 rounded-xl flex flex-col items-center justify-center flex-shrink-0 text-white font-bold" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">
                        <span class="text-lg leading-none">{{ $event->start_date->format('d') }}</span>
                        <span class="text-xs uppercase">{{ $event->start_date->format('M') }}</span>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">{{ $event->title }}</div>
                        <div class="text-sm text-gray-500">{{ $event->start_date->format('g:i A') }}@if($event->location) · {{ $event->location }}@endif</div>
                    </div>
                </a>
                @empty
                <div class="text-center py-12 text-gray-400">No events this month.</div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
