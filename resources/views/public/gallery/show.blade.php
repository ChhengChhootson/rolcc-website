@extends('layouts.app')
@section('title', $album->title . ' — Gallery — ROLCC Cambodia')
@section('content')

<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="mb-8">
                <a href="{{ route('gallery.index') }}" class="text-blue-600 hover:underline text-sm">← Back to Gallery</a>
                <h1 class="text-3xl font-bold text-gray-900 mt-3" style="font-family: Poppins">{{ $album->title }}</h1>
                @if($album->event_date)
                <p class="text-gray-500 mt-1">{{ \Carbon\Carbon::parse($album->event_date)->format('F j, Y') }}</p>
                @endif
                @if($album->description)
                <p class="text-gray-600 mt-3">{{ $album->description }}</p>
                @endif
            </div>

            @if($album->photos->count())
            <div class="columns-2 sm:columns-3 lg:columns-4 gap-3 space-y-3">
                @foreach($album->photos as $photo)
                <div class="break-inside-avoid overflow-hidden rounded-xl cursor-pointer hover:opacity-90 transition-opacity">
                    <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ $photo->caption ?? $album->title }}"
                         class="w-full h-auto block">
                    @if($photo->caption)
                    <p class="text-xs text-gray-500 px-2 py-1">{{ $photo->caption }}</p>
                    @endif
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-16 text-gray-400">
                <p>No photos in this album yet.</p>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
