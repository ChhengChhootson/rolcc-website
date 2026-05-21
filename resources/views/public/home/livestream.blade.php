@extends('layouts.app')
@section('title', 'Live Stream — ROLCC Cambodia')
@section('description', 'Watch ROLCC Cambodia live service stream.')
@section('content')

<section class="py-20 bg-gray-900 text-white">
    <div class="container mx-auto px-4">
        @if(isset($liveStream) && $liveStream)
        <div class="text-center mb-8">
            <span class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 rounded-full text-sm font-bold uppercase tracking-wider animate-pulse">
                <span class="w-2 h-2 bg-white rounded-full"></span> LIVE NOW
            </span>
            <h1 class="text-3xl font-bold mt-4" style="font-family: Poppins">{{ $liveStream->title }}</h1>
        </div>
        <div class="aspect-video max-w-4xl mx-auto rounded-2xl overflow-hidden shadow-2xl">
            <iframe src="{{ $liveStream->stream_url }}" class="w-full h-full" frameborder="0" allowfullscreen
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
        </div>
        @else
        <div class="text-center py-20">
            <div class="w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 bg-white/10">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.069A1 1 0 0121 8.87v6.26a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
            </div>
            <h2 class="text-2xl font-bold mb-3" style="font-family: Poppins">No Live Stream Right Now</h2>
            @if(isset($scheduledStream) && $scheduledStream)
            <p class="text-gray-400 mb-2">Next stream: <span class="text-yellow-400 font-semibold">{{ $scheduledStream->title }}</span></p>
            <p class="text-gray-400">Starting {{ $scheduledStream->scheduled_at?->diffForHumans() }}</p>
            @else
            <p class="text-gray-400">We stream our Sunday services. Join us live every Sunday!</p>
            <div class="mt-3 text-gray-500 text-sm">Sunday English Service: 9:00 AM · Khmer Service: 11:30 AM</div>
            @endif
        </div>
        @endif

        @if(isset($pastStreams) && $pastStreams->count())
        <div class="max-w-4xl mx-auto mt-16">
            <h3 class="text-xl font-bold text-white mb-6" style="font-family: Poppins">Past Streams</h3>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($pastStreams as $stream)
                <div class="bg-white/5 border border-white/10 rounded-xl p-4 hover:bg-white/10 transition-colors">
                    <div class="font-medium text-sm">{{ $stream->title }}</div>
                    <div class="text-gray-400 text-xs mt-1">{{ $stream->ended_at?->format('M j, Y') }}</div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
