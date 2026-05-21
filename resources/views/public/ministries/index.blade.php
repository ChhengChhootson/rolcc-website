@extends('layouts.app')
@section('title', 'Ministries — ROLCC Cambodia')
@section('description', 'Discover the ministries at ROLCC Cambodia. Youth, Kids, Worship, Prayer, Sports, Media, and more.')
@section('content')

<section class="py-20" style="background: linear-gradient(135deg, #082032 0%, #0B4F8C 100%);">
    <div class="container mx-auto px-4 text-center">
        <p class="text-yellow-400 text-sm font-semibold uppercase tracking-widest mb-3">SERVE & GROW</p>
        <h1 class="text-4xl md:text-5xl font-bold text-white" style="font-family: Poppins">Our Ministries</h1>
        <p class="text-blue-200 text-lg mt-4 max-w-xl mx-auto">Find your place to belong, serve, and make a difference in God's Kingdom.</p>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            @foreach($ministries as $ministry)
            <a href="{{ route('ministries.show', $ministry->slug) }}" class="group block bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="relative h-52 overflow-hidden">
                    @if($ministry->image)
                        <img src="{{ asset('storage/' . $ministry->image) }}" alt="{{ $ministry->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center" style="background: linear-gradient(135deg, #0B4F8C, #3C8DDB)">
                            <span class="text-6xl">{{ $ministry->icon ?? '✝' }}</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="flex items-center gap-1 text-white text-xs font-semibold bg-white/20 backdrop-blur px-3 py-1 rounded-full">
                            Learn More <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-700 transition-colors mb-2" style="font-family: Poppins">{{ $ministry->name }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ Str::limit($ministry->short_description ?? $ministry->description, 100) }}</p>
                    @if($ministry->meeting_schedule)
                    <div class="mt-4 flex items-center gap-2 text-blue-600 text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $ministry->meeting_schedule }}
                    </div>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<section class="py-16" style="background: linear-gradient(135deg, #082032 0%, #0B4F8C 100%);">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4" style="font-family: Poppins">Ready to Get Involved?</h2>
        <p class="text-blue-200 mb-8 max-w-xl mx-auto">Every member is a minister. Find your calling and serve God's people with your unique gifts and talents.</p>
        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-yellow-500 hover:bg-yellow-400 text-blue-900 font-bold rounded-full transition-colors">
            Contact Us to Join
        </a>
    </div>
</section>
@endsection
