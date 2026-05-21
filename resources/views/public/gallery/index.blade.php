@extends('layouts.app')
@section('title', 'Photo Gallery — ROLCC Cambodia')
@section('description', 'Browse photos and memories from ROLCC Cambodia church events, ministries, and gatherings.')
@section('content')

<section class="py-20" style="background: linear-gradient(135deg, #082032 0%, #0B4F8C 100%);">
    <div class="container mx-auto px-4 text-center">
        <p class="text-yellow-400 text-sm font-semibold uppercase tracking-widest mb-3">MEMORIES</p>
        <h1 class="text-4xl md:text-5xl font-bold text-white" style="font-family: Poppins">Photo Gallery</h1>
        <p class="text-blue-200 text-lg mt-4 max-w-xl mx-auto">Capturing moments of faith, community, and God's goodness.</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        @if($albums->count())
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @foreach($albums as $album)
            <a href="{{ route('gallery.show', $album->slug) }}" class="group block bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="relative h-52 overflow-hidden">
                    @if($album->cover_image)
                        <img src="{{ asset('storage/' . $album->cover_image) }}" alt="{{ $album->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center" style="background: linear-gradient(135deg, #0B4F8C, #3C8DDB)">
                            <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-3 right-3 bg-white/20 backdrop-blur text-white text-xs font-medium px-3 py-1 rounded-full">
                        {{ $album->photos_count ?? 0 }} photos
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 group-hover:text-blue-700 transition-colors" style="font-family: Poppins">{{ $album->title }}</h3>
                    @if($album->event_date)
                    <p class="text-gray-500 text-sm mt-1">{{ \Carbon\Carbon::parse($album->event_date)->format('F j, Y') }}</p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
        {{ $albums->links() }}
        @else
        <div class="text-center py-20">
            <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <p class="text-gray-500 text-lg">No photos yet. Check back soon!</p>
        </div>
        @endif
    </div>
</section>
@endsection
