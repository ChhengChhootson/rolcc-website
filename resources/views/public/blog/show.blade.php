@extends('layouts.app')
@section('title', $blog->title . ' — ROLCC Cambodia Blog')
@section('description', Str::limit($blog->excerpt ?? strip_tags($blog->content), 160))
@section('content')

<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <a href="{{ route('blog.index') }}" class="text-blue-600 hover:underline text-sm">← Back to Blog</a>
            @if($blog->category)
            <span class="inline-block mt-4 px-3 py-1 text-xs font-bold uppercase tracking-wider text-blue-700 bg-blue-100 rounded-full">{{ $blog->category->name }}</span>
            @endif
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mt-4 mb-4" style="font-family: Poppins">{{ $blog->title }}</h1>
            <div class="flex items-center gap-4 text-sm text-gray-500 mb-8 pb-8 border-b border-gray-100">
                @if($blog->author)
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-sm">
                        {{ substr($blog->author->name, 0, 1) }}
                    </div>
                    <span>{{ $blog->author->name }}</span>
                </div>
                @endif
                @if($blog->published_at) <span>·</span><span>{{ $blog->published_at->format('F j, Y') }}</span> @endif
            </div>
            @if($blog->featured_image)
            <div class="rounded-2xl overflow-hidden mb-10 shadow-lg">
                <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full">
            </div>
            @endif
            <div class="prose prose-lg max-w-none text-gray-700">
                {!! $blog->content !!}
            </div>
            @if(isset($related) && $related->count())
            <div class="mt-14 pt-10 border-t border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 mb-6" style="font-family: Poppins">You may also like</h3>
                <div class="grid sm:grid-cols-2 gap-5">
                    @foreach($related as $rel)
                    <a href="{{ route('blog.show', $rel->slug) }}" class="flex gap-4 group">
                        @if($rel->featured_image)
                        <img src="{{ asset('storage/' . $rel->featured_image) }}" class="w-20 h-16 object-cover rounded-lg flex-shrink-0">
                        @endif
                        <div>
                            <div class="font-semibold text-gray-900 group-hover:text-blue-700 transition-colors text-sm">{{ $rel->title }}</div>
                            <div class="text-xs text-gray-400 mt-1">{{ $rel->published_at?->format('M j, Y') }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
