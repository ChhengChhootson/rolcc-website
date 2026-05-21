@extends('layouts.app')

@section('title', 'Sermons')
@section('description', 'Watch and listen to powerful Bible teachings and sermons from ROLCC Cambodia.')

@section('content')

{{-- Page Hero --}}
<div class="page-hero min-h-[35vh]">
    <div class="absolute inset-0 bg-hero-gradient"></div>
    <div class="absolute inset-0 bg-dark-navy/30"></div>
    <div class="page-hero-content" data-aos="fade-up">
        <span class="inline-block text-church-gold text-sm font-semibold uppercase tracking-widest mb-3">God's Word</span>
        <h1 class="page-hero-title">Sermons & Teachings</h1>
        <p class="text-blue-200 max-w-xl mx-auto text-lg">Grow in faith through powerful Bible-based messages</p>
    </div>
</div>

{{-- Filters --}}
<section class="bg-white border-b border-gray-100 sticky top-16 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form method="GET" action="{{ route('sermons.index') }}" class="flex flex-wrap gap-3 items-center">
            {{-- Search --}}
            <div class="flex-1 min-w-[200px] relative">
                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Search sermons, speakers..."
                       class="form-input pl-10 pr-4">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            {{-- Category --}}
            <select name="category" class="form-select w-auto">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->slug }}" {{ ($filters['category'] ?? '') === $cat->slug ? 'selected' : '' }}>
                    {{ $cat->name }} ({{ $cat->published_sermons_count }})
                </option>
                @endforeach
            </select>

            {{-- Speaker --}}
            <select name="speaker" class="form-select w-auto">
                <option value="">All Speakers</option>
                @foreach($speakers as $speaker)
                <option value="{{ $speaker }}" {{ ($filters['speaker'] ?? '') === $speaker ? 'selected' : '' }}>{{ $speaker }}</option>
                @endforeach
            </select>

            {{-- Year --}}
            <select name="year" class="form-select w-auto">
                <option value="">All Years</option>
                @foreach($years as $year)
                <option value="{{ $year }}" {{ ($filters['year'] ?? '') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn-primary py-2.5 px-5 text-sm">Filter</button>

            @if(array_filter($filters))
            <a href="{{ route('sermons.index') }}" class="text-sm text-gray-400 hover:text-gray-600">Clear</a>
            @endif
        </form>
    </div>
</section>

{{-- Sermons Grid --}}
<section class="py-16 bg-soft-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($sermons->count())
        <div class="flex items-center justify-between mb-6">
            <p class="text-gray-500 text-sm">Showing {{ $sermons->firstItem() }}–{{ $sermons->lastItem() }} of {{ $sermons->total() }} sermons</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($sermons as $sermon)
            <article class="church-card group hover:-translate-y-1" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 80 }}">
                <div class="relative aspect-video overflow-hidden bg-dark-navy">
                    <img src="{{ $sermon->thumbnail_url }}" alt="{{ $sermon->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                         loading="lazy">
                    <div class="absolute inset-0 bg-dark-navy/20 group-hover:bg-dark-navy/10 transition-all"></div>

                    {{-- Play Button --}}
                    <a href="{{ route('sermons.show', $sermon->slug) }}"
                       class="absolute inset-0 flex items-center justify-center">
                        <div class="w-12 h-12 bg-white/90 group-hover:bg-church-gold rounded-full flex items-center justify-center shadow-lg transition-all duration-300 group-hover:scale-110">
                            <svg class="w-5 h-5 text-dark-navy ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    </a>

                    @if($sermon->duration_formatted)
                    <div class="absolute bottom-2 right-2 bg-dark-navy/80 text-white text-xs px-2 py-0.5 rounded font-mono">{{ $sermon->duration_formatted }}</div>
                    @endif

                    @if($sermon->is_featured)
                    <div class="absolute top-2 left-2 bg-church-gold text-dark-navy text-xs font-bold px-2 py-0.5 rounded-full">Featured</div>
                    @endif
                </div>

                <div class="p-4">
                    @if($sermon->category)
                    <span class="text-xs font-semibold uppercase tracking-wide" style="color: {{ $sermon->category->color }}">
                        {{ $sermon->category->name }}
                    </span>
                    @endif

                    <h3 class="font-heading font-bold text-dark-navy mt-1 mb-2 text-sm leading-tight group-hover:text-church-blue transition-colors line-clamp-2">
                        <a href="{{ route('sermons.show', $sermon->slug) }}">{{ $sermon->title }}</a>
                    </h3>

                    <div class="flex items-center justify-between text-xs text-gray-400 mt-3">
                        <div class="flex items-center gap-2">
                            @if($sermon->speaker)
                            <span>{{ $sermon->speaker }}</span>
                            @endif
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                {{ number_format($sermon->views) }}
                            </span>
                        </div>
                    </div>

                    @if($sermon->preached_date)
                    <div class="text-xs text-gray-300 mt-2">{{ $sermon->preached_date->format('M d, Y') }}</div>
                    @endif
                </div>
            </article>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-12 flex justify-center">
            {{ $sermons->appends($filters)->links() }}
        </div>

        @else
        <div class="text-center py-20">
            <svg class="w-16 h-16 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 10l4.553-2.069A1 1 0 0121 8.868v6.264a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            <h3 class="font-heading font-bold text-xl text-gray-400 mb-2">No sermons found</h3>
            <p class="text-gray-400 mb-6">Try adjusting your filters or search terms.</p>
            <a href="{{ route('sermons.index') }}" class="btn-primary">View All Sermons</a>
        </div>
        @endif
    </div>
</section>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init({ once: true, duration: 600 });</script>
@endpush
