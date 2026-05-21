@extends('layouts.app')
@section('title', 'Blog — ROLCC Cambodia')
@section('description', 'Read inspiring articles, devotionals, and stories from ROLCC Cambodia.')
@section('content')

<section class="py-20" style="background: linear-gradient(135deg, #082032 0%, #0B4F8C 100%);">
    <div class="container mx-auto px-4 text-center">
        <p class="text-yellow-400 text-sm font-semibold uppercase tracking-widest mb-3">INSPIRATION</p>
        <h1 class="text-4xl md:text-5xl font-bold text-white" style="font-family: Poppins">Blog & Articles</h1>
        <p class="text-blue-200 text-lg mt-4 max-w-xl mx-auto">Devotionals, testimonies, and resources to help you grow in faith.</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        @if(isset($categories) && $categories->count())
        <div class="flex flex-wrap gap-2 justify-center mb-10">
            <a href="{{ route('blog.index') }}" class="px-4 py-2 rounded-full text-sm font-medium border transition-colors {{ !request('category') ? 'bg-blue-700 text-white border-blue-700' : 'border-gray-300 text-gray-600 hover:border-blue-300' }}">All</a>
            @foreach($categories as $cat)
            <a href="{{ route('blog.index', ['category' => $cat->slug]) }}" class="px-4 py-2 rounded-full text-sm font-medium border transition-colors {{ request('category') == $cat->slug ? 'bg-blue-700 text-white border-blue-700' : 'border-gray-300 text-gray-600 hover:border-blue-300' }}">{{ $cat->name }}</a>
            @endforeach
        </div>
        @endif

        @if($blogs->count())
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            @foreach($blogs as $blog)
            <a href="{{ route('blog.show', $blog->slug) }}" class="group block bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="h-48 overflow-hidden">
                    @if($blog->featured_image)
                        <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center" style="background: linear-gradient(135deg, #0B4F8C, #3C8DDB)">
                            <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                    @endif
                </div>
                <div class="p-6">
                    @if($blog->category)
                    <span class="text-xs font-bold uppercase tracking-wider text-blue-600">{{ $blog->category->name }}</span>
                    @endif
                    <h3 class="font-bold text-gray-900 text-lg mt-2 mb-2 group-hover:text-blue-700 transition-colors" style="font-family: Poppins">{{ $blog->title }}</h3>
                    @if($blog->excerpt)
                    <p class="text-gray-500 text-sm leading-relaxed">{{ Str::limit($blog->excerpt, 100) }}</p>
                    @endif
                    <div class="flex items-center gap-3 mt-4 text-xs text-gray-400">
                        <span>{{ $blog->published_at?->format('M j, Y') }}</span>
                        @if($blog->author) <span>·</span><span>By {{ $blog->author->name }}</span> @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="mt-10">{{ $blogs->links() }}</div>
        @else
        <div class="text-center py-20 text-gray-400">
            <p>No articles yet. Check back soon!</p>
        </div>
        @endif
    </div>
</section>
@endsection
