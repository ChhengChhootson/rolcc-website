@extends('layouts.app')

@section('title', config('church.name'))
@section('description', 'River of Life Christian Church Cambodia — Transforming Lives, Impacting Nations. Join us for worship, community, and growth in Phnom Penh, Cambodia.')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<link rel="stylesheet" href="https://unpkg.com/glightbox/dist/css/glightbox.min.css">
@endpush

@section('content')

{{-- ============================================================ --}}
{{-- HERO SECTION --}}
{{-- ============================================================ --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    {{-- Video/Gradient Background --}}
    <div class="absolute inset-0 bg-hero-gradient"></div>

    {{-- Animated particles/cross overlay --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-sky-blue/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-1/4 left-1/4 w-64 h-64 bg-church-gold/10 rounded-full blur-3xl animate-float" style="animation-delay: 1.5s"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] border border-white/5 rounded-full"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] border border-white/5 rounded-full"></div>
    </div>

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-dark-navy/40"></div>

    {{-- Hero Content --}}
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-32 pt-40">
        {{-- ROLCC Logo --}}
        <div class="flex justify-center mb-8" data-aos="fade-down" data-aos-duration="800">
            <img src="{{ asset('images/logo.png') }}" alt="ROLCC Cambodia" class="h-24 sm:h-32 w-auto drop-shadow-2xl">
        </div>

        {{-- Tagline badge --}}
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white text-xs font-semibold px-4 py-2 rounded-full mb-6 uppercase tracking-widest"
             data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
            <span class="w-1.5 h-1.5 bg-church-gold rounded-full"></span>
            Welcome to ROLCC Cambodia
            <span class="w-1.5 h-1.5 bg-church-gold rounded-full"></span>
        </div>

        {{-- Main Heading --}}
        <h1 class="font-heading font-black text-4xl sm:text-5xl md:text-6xl lg:text-7xl text-white leading-tight mb-6"
            data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
            River of Life<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-church-gold to-amber-400">Christian Church</span>
        </h1>

        <p class="text-xl sm:text-2xl text-blue-100/90 font-light max-w-2xl mx-auto mb-10 leading-relaxed"
           data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
            Transforming Lives, Impacting Nations
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12"
             data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
            <a href="{{ route('about') }}" class="w-full sm:w-auto bg-white text-dark-navy font-bold px-8 py-4 rounded-full text-base hover:bg-church-gold hover:text-dark-navy transition-all duration-300 shadow-church-lg hover:shadow-gold">
                Discover Our Church
            </a>
            <a href="{{ route('sermons.index') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 border-2 border-white/40 text-white font-semibold px-8 py-4 rounded-full text-base hover:bg-white/10 hover:border-white transition-all duration-300 backdrop-blur-sm">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                Watch Sermons
            </a>
        </div>

        {{-- Service Schedule Quick View --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 max-w-3xl mx-auto"
             data-aos="fade-up" data-aos-duration="800" data-aos-delay="500">
            @foreach(config('church.service_times') as $service)
            <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-3 text-center hover:bg-white/15 transition-all duration-300">
                <div class="text-church-gold font-bold text-xs uppercase tracking-wide mb-1">{{ $service['day'] }}</div>
                <div class="text-white font-semibold text-sm">{{ $service['time'] }}</div>
                <div class="text-blue-200/70 text-xs mt-1">{{ $service['name'] }}</div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <div class="w-6 h-10 border-2 border-white/40 rounded-full flex justify-center">
            <div class="w-1 h-3 bg-white/60 rounded-full mt-2 animate-scroll-down"></div>
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- WELCOME / STATS SECTION --}}
{{-- ============================================================ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div data-aos="fade-right">
                <span class="inline-block text-church-blue font-semibold text-sm uppercase tracking-widest mb-3">Welcome Home</span>
                <h2 class="font-heading font-bold text-3xl sm:text-4xl text-dark-navy mb-6 leading-tight">
                    A Family of Faith,<br><span class="text-church-blue">Hope & Love</span>
                </h2>
                <p class="text-gray-600 leading-relaxed mb-5 text-lg">
                    River of Life Christian Church Cambodia is a spirit-filled, Bible-based international church located in the heart of Phnom Penh. We believe in the transforming power of God's Word.
                </p>
                <p class="text-gray-600 leading-relaxed mb-8">
                    Whether you're a long-time believer or exploring faith for the first time, you are welcome here. Join thousands of believers who have found their spiritual home at ROLCC Cambodia.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('about') }}" class="btn-primary">Learn Our Story</a>
                    <a href="{{ route('contact') }}" class="btn-secondary">Plan Your Visit</a>
                </div>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-2 gap-5" data-aos="fade-left">
                <div class="stat-card bg-hero-gradient text-white">
                    <div class="stat-number text-church-gold" data-target="{{ \App\Models\Sermon::published()->count() ?: 200 }}">0</div>
                    <div class="stat-label">Sermons Preached</div>
                </div>
                <div class="stat-card bg-white border-2 border-church-blue/20 shadow-church">
                    <div class="stat-number text-church-blue" data-target="{{ \App\Models\Ministry::active()->count() ?: 7 }}">0</div>
                    <div class="stat-label text-gray-600">Active Ministries</div>
                </div>
                <div class="stat-card bg-white border-2 border-church-gold/20 shadow-church">
                    <div class="stat-number text-church-gold" data-target="{{ date('Y') - config('church.founded_year') }}">0</div>
                    <div class="stat-label text-gray-600">Years of Ministry</div>
                </div>
                <div class="stat-card bg-dark-navy text-white">
                    <div class="stat-number text-sky-blue" data-target="{{ \App\Models\Event::published()->count() ?: 50 }}">0</div>
                    <div class="stat-label">Events This Year</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- LIVE STREAM CTA --}}
{{-- ============================================================ --}}
@if($live_stream)
<section class="py-10 bg-red-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <span class="w-4 h-4 bg-white rounded-full animate-ping absolute"></span>
                <span class="w-4 h-4 bg-white rounded-full relative"></span>
                <div>
                    <div class="text-white font-bold text-lg">We're Live Now!</div>
                    <div class="text-red-100 text-sm">{{ $live_stream->title }}</div>
                </div>
            </div>
            <a href="{{ route('livestream') }}" class="bg-white text-red-600 font-bold px-8 py-3 rounded-full hover:bg-red-50 transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                Watch Live Stream
            </a>
        </div>
    </div>
</section>
@else
<section class="py-16 bg-gradient-to-r from-church-blue to-royal-blue">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 text-sky-blue text-sm font-medium mb-3">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.868v6.264a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            Online Worship
        </div>
        <h2 class="font-heading font-bold text-2xl sm:text-3xl text-white mb-3">Can't Make It In Person?</h2>
        <p class="text-blue-200 mb-8 max-w-xl mx-auto">Join us online every Sunday. Watch our live streams and archived services on YouTube and Facebook.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('livestream') }}" class="bg-white text-church-blue font-bold px-8 py-3.5 rounded-full hover:bg-blue-50 transition-colors">Watch Live Streams</a>
            <a href="{{ route('sermons.index') }}" class="border-2 border-white/40 text-white font-semibold px-8 py-3.5 rounded-full hover:bg-white/10 transition-colors">Watch Past Sermons</a>
        </div>
    </div>
</section>
@endif

{{-- ============================================================ --}}
{{-- LATEST SERMONS --}}
{{-- ============================================================ --}}
<section class="py-20 bg-soft-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="section-header" data-aos="fade-up">
            <span class="section-badge">Sermons</span>
            <h2 class="section-title">Latest Messages</h2>
            <p class="section-subtitle">Dive deep into God's Word through our weekly sermon series</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-12">
            @foreach($featured_sermons as $sermon)
            <article class="bg-white rounded-2xl overflow-hidden shadow-church hover:shadow-church-lg transition-all duration-300 group hover:-translate-y-1"
                     data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="relative aspect-video overflow-hidden bg-dark-navy">
                    <img src="{{ $sermon->thumbnail_url }}"
                         alt="{{ $sermon->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         loading="lazy">
                    <div class="absolute inset-0 bg-dark-navy/30 group-hover:bg-dark-navy/10 transition-all duration-300"></div>

                    {{-- Play button --}}
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-12 h-12 bg-white/90 group-hover:bg-white rounded-full flex items-center justify-center shadow-lg transition-all duration-300 group-hover:scale-110">
                            <svg class="w-5 h-5 text-church-blue ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </div>

                    @if($sermon->is_featured)
                    <div class="absolute top-3 left-3 bg-church-gold text-dark-navy text-xs font-bold px-2.5 py-1 rounded-full">Featured</div>
                    @endif
                </div>

                <div class="p-5">
                    @if($sermon->category)
                    <span class="text-xs font-semibold text-church-blue uppercase tracking-wide">{{ $sermon->category->name }}</span>
                    @endif
                    <h3 class="font-heading font-bold text-dark-navy mt-1 mb-2 text-base leading-tight group-hover:text-church-blue transition-colors line-clamp-2">
                        <a href="{{ route('sermons.show', $sermon->slug) }}">{{ $sermon->title }}</a>
                    </h3>
                    <div class="flex items-center gap-3 text-xs text-gray-400 mt-3">
                        @if($sermon->speaker)
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ $sermon->speaker }}
                        </span>
                        @endif
                        @if($sermon->preached_date)
                        <span>{{ $sermon->preached_date->format('M d, Y') }}</span>
                        @endif
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center mt-10" data-aos="fade-up">
            <a href="{{ route('sermons.index') }}" class="btn-primary">View All Sermons</a>
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- MINISTRIES --}}
{{-- ============================================================ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="section-header" data-aos="fade-up">
            <span class="section-badge">Community</span>
            <h2 class="section-title">Our Ministries</h2>
            <p class="section-subtitle">Discover your calling and find your place to serve</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-12">
            @foreach($ministries as $ministry)
            <a href="{{ route('ministries.show', $ministry->slug) }}"
               class="group relative overflow-hidden rounded-2xl shadow-church hover:shadow-church-lg transition-all duration-300 hover:-translate-y-1"
               data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="relative h-56 overflow-hidden">
                    <img src="{{ $ministry->featured_image_url }}"
                         alt="{{ $ministry->name }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark-navy/90 via-dark-navy/40 to-transparent"></div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-5">
                    <div class="flex items-center gap-2 mb-2">
                        @if($ministry->icon)
                        <span class="text-church-gold text-xl">{{ $ministry->icon }}</span>
                        @endif
                        <h3 class="font-heading font-bold text-white text-lg">{{ $ministry->name }}</h3>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed line-clamp-2">{{ $ministry->short_description }}</p>
                    <div class="mt-3 flex items-center gap-1 text-church-gold text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity">
                        Learn More <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-10" data-aos="fade-up">
            <a href="{{ route('ministries.index') }}" class="btn-primary">Explore All Ministries</a>
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- UPCOMING EVENTS --}}
{{-- ============================================================ --}}
<section class="py-20 bg-dark-navy">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="section-header" data-aos="fade-up">
            <span class="inline-block text-church-gold font-semibold text-sm uppercase tracking-widest mb-3">Events</span>
            <h2 class="font-heading font-bold text-3xl sm:text-4xl text-white mb-3">Upcoming Events</h2>
            <p class="text-gray-400 max-w-2xl mx-auto">Join us for worship, community gatherings, and special events</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
            @forelse($upcoming_events as $event)
            <a href="{{ route('events.show', $event->slug) }}"
               class="group bg-white/5 hover:bg-white/10 border border-white/10 hover:border-sky-blue/40 rounded-2xl overflow-hidden transition-all duration-300"
               data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                @if($event->featured_image)
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ $event->featured_image_url }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-dark-navy/70 to-transparent"></div>
                    <div class="absolute top-3 left-3 bg-church-gold text-dark-navy font-bold text-xs px-2.5 py-1 rounded-full">
                        {{ $event->start_date->format('M d') }}
                    </div>
                </div>
                @endif
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-xs bg-church-blue/20 text-sky-blue px-2 py-0.5 rounded-full capitalize">{{ $event->event_type }}</span>
                        @if($event->is_online)
                        <span class="text-xs bg-green-500/20 text-green-400 px-2 py-0.5 rounded-full">Online</span>
                        @endif
                    </div>
                    <h3 class="font-heading font-bold text-white text-base leading-tight mb-2 group-hover:text-sky-blue transition-colors line-clamp-2">{{ $event->title }}</h3>
                    <div class="space-y-1.5 text-xs text-gray-400">
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-church-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $event->start_date->format('D, M d, Y • g:i A') }}
                        </div>
                        @if($event->location)
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-church-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $event->location }}
                        </div>
                        @endif
                    </div>
                    @if($event->requires_registration)
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-xs text-gray-500">{{ $event->available_spots ? $event->available_spots . ' spots left' : 'Registration required' }}</span>
                        <span class="text-xs font-semibold text-sky-blue">Register →</span>
                    </div>
                    @endif
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-12 text-gray-500">No upcoming events. Check back soon!</div>
            @endforelse
        </div>

        <div class="text-center mt-10" data-aos="fade-up">
            <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 border-2 border-white/30 text-white font-semibold px-8 py-3.5 rounded-full hover:bg-white/10 transition-all duration-300">
                View All Events
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- TESTIMONIALS --}}
{{-- ============================================================ --}}
@if($testimonials->count())
<section class="py-20 bg-soft-white relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-0 w-64 h-64 bg-church-blue/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-church-gold/5 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="section-header" data-aos="fade-up">
            <span class="section-badge">Testimonies</span>
            <h2 class="section-title">Lives Transformed</h2>
            <p class="section-subtitle">Hear from those whose lives have been changed by God's grace</p>
        </div>

        <div class="swiper testimonial-swiper mt-12" data-aos="fade-up">
            <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                <div class="swiper-slide">
                    <div class="bg-white rounded-2xl p-8 shadow-church h-full">
                        <div class="flex items-center gap-1 mb-4">
                            @for($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4 {{ $i < $testimonial->rating ? 'text-church-gold' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        <blockquote class="text-gray-600 leading-relaxed mb-6 text-base italic">
                            "{{ $testimonial->content }}"
                        </blockquote>
                        <div class="flex items-center gap-3">
                            <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <div class="font-semibold text-dark-navy">{{ $testimonial->name }}</div>
                                @if($testimonial->title)
                                <div class="text-sm text-church-blue">{{ $testimonial->title }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination mt-6"></div>
        </div>
    </div>
</section>
@endif

{{-- ============================================================ --}}
{{-- PRAYER & DONATION CTA --}}
{{-- ============================================================ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Prayer CTA --}}
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-church-blue to-royal-blue p-10 text-white"
                 data-aos="fade-right">
                <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2"></div>
                <div class="relative">
                    <div class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <h3 class="font-heading font-bold text-2xl sm:text-3xl mb-3">Need Prayer?</h3>
                    <p class="text-blue-100 mb-6 leading-relaxed">Our prayer team is here for you. Submit your prayer request and know that you are not alone.</p>
                    <a href="{{ route('prayer.index') }}" class="inline-flex items-center gap-2 bg-white text-church-blue font-bold px-6 py-3 rounded-full hover:bg-blue-50 transition-colors">
                        Submit Prayer Request
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            {{-- Donation CTA --}}
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-church-gold to-amber-500 p-10 text-dark-navy"
                 data-aos="fade-left">
                <div class="absolute top-0 right-0 w-48 h-48 bg-dark-navy/5 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2"></div>
                <div class="relative">
                    <div class="w-14 h-14 bg-dark-navy/10 rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-heading font-bold text-2xl sm:text-3xl mb-3">Support Our Mission</h3>
                    <p class="text-amber-800 mb-6 leading-relaxed">Your generous giving helps us reach more people, run programs, and impact communities across Cambodia and beyond.</p>
                    <a href="{{ route('donate') }}" class="inline-flex items-center gap-2 bg-dark-navy text-white font-bold px-6 py-3 rounded-full hover:bg-royal-blue transition-colors">
                        Give Now
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- NEWSLETTER --}}
{{-- ============================================================ --}}
<section class="py-16 bg-hero-gradient">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <img src="{{ asset('images/logo.png') }}" alt="ROLCC" class="h-14 w-auto mx-auto mb-5 opacity-90">
        <h2 class="font-heading font-bold text-2xl sm:text-3xl text-white mb-3">Stay Connected with ROLCC</h2>
        <p class="text-blue-200 mb-8">Get the latest sermons, events, and church news delivered to your inbox.</p>

        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto">
            @csrf
            <input type="text" name="name" placeholder="Your name" class="flex-1 bg-white/15 border border-white/30 text-white placeholder-blue-200 rounded-full px-5 py-3 text-sm focus:outline-none focus:border-white transition-colors">
            <input type="email" name="email" required placeholder="Your email address" class="flex-1 bg-white/15 border border-white/30 text-white placeholder-blue-200 rounded-full px-5 py-3 text-sm focus:outline-none focus:border-white transition-colors">
            <button type="submit" class="bg-church-gold hover:bg-amber-500 text-dark-navy font-bold px-6 py-3 rounded-full text-sm transition-colors whitespace-nowrap">
                Subscribe
            </button>
        </form>
        <p class="text-blue-300/60 text-xs mt-3">No spam, unsubscribe anytime.</p>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
AOS.init({ once: true, offset: 50, duration: 700, easing: 'ease-out-cubic' });

// Counter animations
const counters = document.querySelectorAll('.stat-number[data-target]');
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const el = entry.target;
            const target = parseInt(el.dataset.target);
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;
            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                el.textContent = Math.floor(current) + (target > 10 ? '+' : '');
            }, 16);
            observer.unobserve(el);
        }
    });
}, { threshold: 0.5 });

counters.forEach(counter => observer.observe(counter));

// Testimonials Swiper
new Swiper('.testimonial-swiper', {
    slidesPerView: 1,
    spaceBetween: 24,
    loop: true,
    autoplay: { delay: 5000, disableOnInteraction: false },
    pagination: { el: '.swiper-pagination', clickable: true },
    breakpoints: {
        640: { slidesPerView: 2 },
        1024: { slidesPerView: 3 },
    },
});
</script>
@endpush
