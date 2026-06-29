@extends('layouts.app')

@section('title', config('church.name'))
@section('description', 'River of Life Christian Church Cambodia — Transforming Lives, Impacting Nations. Join us for worship, community, and growth in Phnom Penh, Cambodia.')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
@endpush

@section('content')

{{-- ============================================================ --}}
{{-- HERO --}}
{{-- ============================================================ --}}
<section class="relative min-h-screen flex flex-col items-center justify-center overflow-hidden bg-[#04101c]">

    {{-- Background glow --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[900px] h-[500px] rounded-full"
             style="background: radial-gradient(ellipse at center, rgba(20,93,160,0.22) 0%, transparent 70%);"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[400px]"
             style="background: radial-gradient(ellipse at bottom right, rgba(212,160,23,0.07) 0%, transparent 70%);"></div>
    </div>

    {{-- Grid overlay --}}
    <div class="absolute inset-0 bg-grid-faint opacity-60 pointer-events-none"></div>

    {{-- Content --}}
    <div class="relative z-10 max-w-5xl mx-auto px-5 sm:px-6 lg:px-8 text-center pt-28 pb-20">

        {{-- Logo --}}
        <div class="flex justify-center mb-10" data-aos="fade-down" data-aos-duration="700">
            <img src="{{ asset('images/logo.png') }}" alt="ROLCC Cambodia" class="h-20 sm:h-24 w-auto drop-shadow-2xl">
        </div>

        {{-- Eyebrow --}}
        <div class="inline-flex items-center gap-3 mb-7" data-aos="fade-up" data-aos-delay="50">
            <span class="block w-8 h-px bg-church-gold/50"></span>
            <span class="text-church-gold text-[11px] font-bold uppercase tracking-[0.2em]">Welcome to ROLCC Cambodia</span>
            <span class="block w-8 h-px bg-church-gold/50"></span>
        </div>

        {{-- Heading --}}
        <h1 class="font-heading font-black text-5xl sm:text-6xl md:text-7xl lg:text-[5.5rem] text-white leading-[1.04] tracking-tight mb-6"
            data-aos="fade-up" data-aos-delay="100">
            River of Life<br>
            <span class="text-church-gold">Christian Church</span>
        </h1>

        <p class="text-white/45 text-lg sm:text-xl font-light max-w-lg mx-auto mb-12 leading-relaxed"
           data-aos="fade-up" data-aos-delay="150">
            Transforming Lives, Impacting Nations across Cambodia and beyond.
        </p>

        {{-- CTAs --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mb-16"
             data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('about') }}"
               class="w-full sm:w-auto bg-white hover:bg-church-gold text-dark-navy font-semibold text-[13.5px] px-8 py-3.5 rounded-lg transition-all duration-200 shadow-sm">
                Discover Our Church
            </a>
            <a href="{{ route('sermons.index') }}"
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 border border-white/15 hover:border-white/30 text-white/75 hover:text-white font-semibold text-[13.5px] px-8 py-3.5 rounded-lg transition-all duration-200">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                Watch Sermons
            </a>
        </div>

        {{-- Service times --}}
        <div class="flex flex-wrap justify-center gap-3" data-aos="fade-up" data-aos-delay="250">
            @foreach(config('church.service_times') as $service)
            <div class="bg-white/[0.06] hover:bg-white/[0.09] border border-white/[0.1] rounded-xl px-5 py-3 text-center transition-colors duration-200">
                <div class="text-church-gold text-[10.5px] font-bold uppercase tracking-widest">{{ $service['day'] }}</div>
                <div class="text-white font-semibold text-sm mt-0.5">{{ $service['time'] }}</div>
                <div class="text-white/35 text-[10.5px] mt-0.5">{{ $service['name'] }}</div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1">
        <span class="text-[9.5px] text-white/25 uppercase tracking-[0.2em]">Scroll</span>
        <svg class="w-4 h-4 text-white/25 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
</section>

{{-- ============================================================ --}}
{{-- LIVE STREAM BANNER (conditional) --}}
{{-- ============================================================ --}}
@if($live_stream)
<div class="bg-red-600 text-white">
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-3.5 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <span class="relative flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-white"></span>
            </span>
            <span class="font-semibold text-sm">We're Live Now</span>
            <span class="text-red-200 text-sm hidden sm:inline">— {{ $live_stream->title }}</span>
        </div>
        <a href="{{ route('livestream') }}"
           class="text-[13px] font-bold bg-white/20 hover:bg-white/30 text-white px-5 py-2 rounded-lg transition-colors shrink-0">
            Watch Live →
        </a>
    </div>
</div>
@endif

{{-- ============================================================ --}}
{{-- WELCOME --}}
{{-- ============================================================ --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 xl:gap-24 items-center">

            {{-- Text --}}
            <div data-aos="fade-right" data-aos-duration="700">
                <span class="section-eyebrow">Welcome Home</span>
                <h2 class="font-heading font-bold text-4xl sm:text-5xl text-dark-navy mt-1 mb-6 leading-tight">
                    A Family of<br>Faith, Hope & Love
                </h2>
                <p class="text-gray-500 text-[15px] leading-relaxed mb-4">
                    River of Life Christian Church Cambodia is a spirit-filled, Bible-based international church located in the heart of Phnom Penh. We believe in the transforming power of God's Word.
                </p>
                <p class="text-gray-500 text-[15px] leading-relaxed mb-8">
                    Whether you're a long-time believer or exploring faith for the first time, you are welcome here. Join our family and discover a community that loves God and loves people.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('about') }}" class="btn-primary">Learn Our Story</a>
                    <a href="{{ route('contact') }}" class="btn-secondary">Plan Your Visit</a>
                </div>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-2 gap-4" data-aos="fade-left" data-aos-duration="700">
                @php
                $stats = [
                    ['value' => \App\Models\Sermon::published()->count() ?: 200, 'label' => 'Sermons Preached',  'color' => 'text-church-blue'],
                    ['value' => \App\Models\Ministry::active()->count()  ?: 7,   'label' => 'Active Ministries', 'color' => 'text-church-gold'],
                    ['value' => date('Y') - config('church.founded_year'),       'label' => 'Years of Ministry', 'color' => 'text-church-blue'],
                    ['value' => \App\Models\Event::published()->count()  ?: 50,  'label' => 'Events This Year',  'color' => 'text-church-gold'],
                ];
                @endphp
                @foreach($stats as $stat)
                <div class="stat-card">
                    <div class="stat-number {{ $stat['color'] }} stat-counter" data-target="{{ $stat['value'] }}">0</div>
                    <div class="stat-label">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- LATEST SERMONS --}}
{{-- ============================================================ --}}
<section class="py-24 bg-[#f8fafc]">
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">

        <div class="section-header mb-14" data-aos="fade-up">
            <span class="section-eyebrow">Messages</span>
            <h2 class="section-title">Latest Sermons</h2>
            <p class="section-subtitle">Dive deep into God's Word through our weekly messages</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($featured_sermons as $sermon)
            <article class="card group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="relative aspect-video overflow-hidden bg-dark-navy">
                    <img src="{{ $sermon->thumbnail_url }}"
                         alt="{{ $sermon->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90 group-hover:opacity-100"
                         loading="lazy">
                    {{-- Play button --}}
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-11 h-11 rounded-full bg-white/90 flex items-center justify-center shadow-lg group-hover:bg-white group-hover:scale-110 transition-all duration-300">
                            <svg class="w-4 h-4 text-church-blue ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>
                    @if($sermon->is_featured)
                    <div class="absolute top-2.5 left-2.5 badge badge-gold text-[10.5px]">Featured</div>
                    @endif
                </div>
                <div class="p-4">
                    @if($sermon->category)
                    <span class="text-[11px] font-bold text-church-blue uppercase tracking-wider">{{ $sermon->category->name }}</span>
                    @endif
                    <h3 class="font-heading font-semibold text-dark-navy text-[14px] leading-snug mt-1 mb-3 line-clamp-2 group-hover:text-church-blue transition-colors">
                        <a href="{{ route('sermons.show', $sermon->slug) }}">{{ $sermon->title }}</a>
                    </h3>
                    <div class="flex items-center gap-3 text-[11.5px] text-gray-400">
                        @if($sermon->speaker)
                        <span>{{ $sermon->speaker }}</span>
                        @endif
                        @if($sermon->preached_date)
                        <span class="text-gray-300">·</span>
                        <span>{{ $sermon->preached_date->format('M d, Y') }}</span>
                        @endif
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ route('sermons.index') }}" class="btn-primary">View All Sermons</a>
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- MINISTRIES --}}
{{-- ============================================================ --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">

        <div class="section-header mb-14" data-aos="fade-up">
            <span class="section-eyebrow">Community</span>
            <h2 class="section-title">Our Ministries</h2>
            <p class="section-subtitle">Find where you belong and discover your calling</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($ministries as $ministry)
            <a href="{{ route('ministries.show', $ministry->slug) }}"
               class="group relative overflow-hidden rounded-2xl aspect-[4/3]"
               data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                <img src="{{ $ministry->featured_image_url }}"
                     alt="{{ $ministry->name }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                     loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-[#04101c]/90 via-[#04101c]/30 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6">
                    <div class="flex items-center gap-2 mb-1">
                        @if($ministry->icon)
                        <span class="text-church-gold">{{ $ministry->icon }}</span>
                        @endif
                        <h3 class="font-heading font-bold text-white text-lg leading-tight">{{ $ministry->name }}</h3>
                    </div>
                    <p class="text-white/60 text-[13px] line-clamp-2 leading-relaxed">{{ $ministry->short_description }}</p>
                    <span class="inline-flex items-center gap-1 mt-3 text-church-gold text-[12px] font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        Learn More
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ route('ministries.index') }}" class="btn-primary">Explore All Ministries</a>
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- UPCOMING EVENTS --}}
{{-- ============================================================ --}}
<section class="py-24 bg-[#04101c]">
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">

        <div class="section-header mb-14" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 text-church-gold text-[11px] font-bold uppercase tracking-[0.16em] mb-4">
                <span class="block w-5 h-px bg-church-gold/40"></span>
                Upcoming
                <span class="block w-5 h-px bg-church-gold/40"></span>
            </span>
            <h2 class="font-heading font-bold text-[1.85rem] sm:text-4xl text-white leading-tight mb-4">Events & Gatherings</h2>
            <p class="text-white/40 text-[15px]">Join us for worship, community, and special gatherings</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @forelse($upcoming_events as $event)
            <a href="{{ route('events.show', $event->slug) }}"
               class="group card-dark rounded-2xl overflow-hidden"
               data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                @if($event->featured_image)
                <div class="relative h-44 overflow-hidden">
                    <img src="{{ $event->featured_image_url }}" alt="{{ $event->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-80 group-hover:opacity-100"
                         loading="lazy">
                    <div class="absolute top-3 left-3 bg-church-gold text-dark-navy font-bold text-[11px] px-2.5 py-1 rounded-lg">
                        {{ $event->start_date->format('M d') }}
                    </div>
                </div>
                @endif
                <div class="p-5">
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        <span class="badge badge-blue capitalize">{{ $event->event_type }}</span>
                        @if($event->is_online)
                        <span class="badge badge-green">Online</span>
                        @endif
                    </div>
                    <h3 class="font-heading font-semibold text-white text-[15px] leading-snug mb-3 line-clamp-2 group-hover:text-sky-blue transition-colors">
                        {{ $event->title }}
                    </h3>
                    <div class="space-y-1.5 text-[12px] text-white/40">
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-church-gold/70 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $event->start_date->format('D, M d · g:i A') }}
                        </div>
                        @if($event->location)
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-church-gold/70 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            {{ $event->location }}
                        </div>
                        @endif
                    </div>
                    @if($event->requires_registration)
                    <div class="mt-4 pt-4 border-t border-white/[0.07] flex items-center justify-between">
                        <span class="text-[11.5px] text-white/30">{{ $event->available_spots ? $event->available_spots . ' spots left' : 'Registration required' }}</span>
                        <span class="text-[12px] font-semibold text-sky-blue">Register →</span>
                    </div>
                    @endif
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-16 text-white/30 text-sm">No upcoming events. Check back soon!</div>
            @endforelse
        </div>

        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ route('events.index') }}" class="btn-outline-white">View All Events</a>
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- TESTIMONIALS --}}
{{-- ============================================================ --}}
@if($testimonials->count())
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">

        <div class="section-header mb-14" data-aos="fade-up">
            <span class="section-eyebrow">Stories</span>
            <h2 class="section-title">Lives Transformed</h2>
            <p class="section-subtitle">Hear from those whose lives have been changed by God's grace</p>
        </div>

        <div class="swiper testimonial-swiper" data-aos="fade-up">
            <div class="swiper-wrapper pb-10">
                @foreach($testimonials as $testimonial)
                <div class="swiper-slide h-auto">
                    <div class="card p-7 h-full flex flex-col">
                        {{-- Stars --}}
                        <div class="flex items-center gap-0.5 mb-5">
                            @for($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4 {{ $i < $testimonial->rating ? 'text-church-gold' : 'text-gray-200' }}"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            @endfor
                        </div>
                        <blockquote class="text-gray-600 text-[14.5px] leading-relaxed italic flex-1 mb-6">
                            "{{ $testimonial->content }}"
                        </blockquote>
                        <div class="flex items-center gap-3">
                            <img src="{{ $testimonial->photo_url }}"
                                 alt="{{ $testimonial->name }}"
                                 class="w-10 h-10 rounded-full object-cover shrink-0">
                            <div>
                                <div class="font-semibold text-dark-navy text-[13.5px]">{{ $testimonial->name }}</div>
                                @if($testimonial->title)
                                <div class="text-[12px] text-church-blue">{{ $testimonial->title }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
@endif

{{-- ============================================================ --}}
{{-- PRAYER & DONATE --}}
{{-- ============================================================ --}}
<section class="py-24 bg-[#f8fafc]">
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Prayer --}}
            <div class="rounded-2xl bg-dark-navy p-10 relative overflow-hidden" data-aos="fade-right">
                <div class="absolute top-0 right-0 w-64 h-64 rounded-full"
                     style="background: radial-gradient(circle, rgba(20,93,160,0.25) 0%, transparent 70%); transform: translate(30%,-30%);"></div>
                <div class="relative">
                    <div class="w-12 h-12 bg-church-blue/20 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-sky-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-heading font-bold text-white text-2xl sm:text-3xl mb-3">Need Prayer?</h3>
                    <p class="text-white/45 text-[14.5px] leading-relaxed mb-7">Our prayer team is here for you. Submit your request and know that you are not alone.</p>
                    <a href="{{ route('prayer.index') }}" class="btn-primary">Submit Prayer Request</a>
                </div>
            </div>

            {{-- Donate --}}
            <div class="rounded-2xl bg-church-gold p-10 relative overflow-hidden" data-aos="fade-left">
                <div class="absolute top-0 right-0 w-64 h-64 rounded-full"
                     style="background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%); transform: translate(30%,-30%);"></div>
                <div class="relative">
                    <div class="w-12 h-12 bg-dark-navy/10 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-dark-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-heading font-bold text-dark-navy text-2xl sm:text-3xl mb-3">Support Our Mission</h3>
                    <p class="text-dark-navy/60 text-[14.5px] leading-relaxed mb-7">Your generosity helps us reach more people and impact communities across Cambodia and beyond.</p>
                    <a href="{{ route('donate') }}"
                       class="inline-flex items-center gap-2 bg-dark-navy hover:bg-royal-blue text-white font-semibold text-[13.5px] px-6 py-3 rounded-lg transition-colors duration-200">
                        Give Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
AOS.init({ once: true, offset: 40, duration: 650, easing: 'ease-out-quad' });

// Counter animation
const counters = document.querySelectorAll('.stat-counter');
if (counters.length) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            const target = parseInt(el.dataset.target);
            let start = 0;
            const duration = 1800;
            const step = target / (duration / 16);
            const timer = setInterval(() => {
                start += step;
                if (start >= target) { start = target; clearInterval(timer); }
                el.textContent = Math.floor(start) + (target >= 10 ? '+' : '');
            }, 16);
            observer.unobserve(el);
        });
    }, { threshold: 0.4 });
    counters.forEach(c => observer.observe(c));
}

// Testimonial swiper
if (document.querySelector('.testimonial-swiper')) {
    new Swiper('.testimonial-swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: { delay: 5500, disableOnInteraction: false },
        pagination: { el: '.swiper-pagination', clickable: true },
        breakpoints: {
            640:  { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        },
    });
}
</script>
@endpush
