@extends('layouts.app')
@section('title', $sermon->title . ' — ROLCC Cambodia')
@section('description', Str::limit($sermon->description, 160))
@section('content')

<section class="py-20" style="background: linear-gradient(135deg, #082032 0%, #0B4F8C 100%);">
    <div class="container mx-auto px-4 text-center">
        @if($sermon->category)
        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-4 text-white" style="background: rgba(212,160,23,0.3)">{{ $sermon->category->name }}</span>
        @endif
        <h1 class="text-3xl md:text-4xl font-bold text-white max-w-3xl mx-auto" style="font-family: Poppins">{{ $sermon->title }}</h1>
        <div class="flex items-center justify-center gap-4 mt-5 text-blue-200 text-sm flex-wrap">
            @if($sermon->speaker) <span>By {{ $sermon->speaker }}</span> @endif
            @if($sermon->published_at) <span>·</span><span>{{ $sermon->published_at->format('F j, Y') }}</span> @endif
        </div>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-10 max-w-6xl mx-auto">
            <div class="lg:col-span-2">
                @if($sermon->video_url)
                <div class="aspect-video rounded-2xl overflow-hidden shadow-xl mb-8">
                    @php
                        $embedUrl = $sermon->embed_url ?? $sermon->video_url;
                    @endphp
                    <iframe src="{{ $embedUrl }}" class="w-full h-full" frameborder="0" allowfullscreen
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                </div>
                @endif

                @if($sermon->description)
                <div class="prose prose-lg max-w-none text-gray-700 mb-8">
                    <p>{{ $sermon->description }}</p>
                </div>
                @endif

                @if($sermon->scripture_reference)
                <div class="p-4 bg-blue-50 border border-blue-100 rounded-xl mb-6">
                    <div class="text-blue-700 font-semibold text-sm uppercase tracking-wide mb-1">Scripture Reference</div>
                    <div class="text-blue-900 font-medium">{{ $sermon->scripture_reference }}</div>
                </div>
                @endif

                @if($sermon->audio_url)
                <div class="p-4 bg-gray-50 rounded-xl mb-6">
                    <div class="font-semibold text-gray-700 mb-3">Listen to this sermon</div>
                    <audio controls class="w-full">
                        <source src="{{ $sermon->audio_url }}" type="audio/mpeg">
                    </audio>
                </div>
                @endif

                @if(isset($related) && $related->count())
                <div class="mt-12">
                    <h3 class="text-xl font-bold text-gray-900 mb-6" style="font-family: Poppins">Related Sermons</h3>
                    <div class="space-y-3">
                        @foreach($related as $rel)
                        <a href="{{ route('sermons.show', $rel->slug) }}" class="flex gap-4 p-4 border border-gray-100 rounded-xl hover:border-blue-200 hover:shadow-md transition-all group">
                            @if($rel->thumbnail)
                                <img src="{{ asset('storage/' . $rel->thumbnail) }}" alt="{{ $rel->title }}" class="w-20 h-14 object-cover rounded-lg flex-shrink-0">
                            @endif
                            <div>
                                <div class="font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">{{ $rel->title }}</div>
                                <div class="text-sm text-gray-500">{{ $rel->speaker }} · {{ $rel->published_at?->format('M j, Y') }}</div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div>
                <div class="bg-gray-50 rounded-2xl p-6 sticky top-24 space-y-5">
                    <h3 class="font-bold text-gray-900" style="font-family: Poppins">Sermon Info</h3>
                    <div class="space-y-3 text-sm">
                        @if($sermon->speaker)
                        <div class="flex justify-between"><span class="text-gray-500">Speaker</span><span class="font-medium">{{ $sermon->speaker }}</span></div>
                        @endif
                        @if($sermon->published_at)
                        <div class="flex justify-between"><span class="text-gray-500">Date</span><span class="font-medium">{{ $sermon->published_at->format('M j, Y') }}</span></div>
                        @endif
                        @if($sermon->category)
                        <div class="flex justify-between"><span class="text-gray-500">Category</span><span class="font-medium">{{ $sermon->category->name }}</span></div>
                        @endif
                        @if($sermon->duration_formatted)
                        <div class="flex justify-between"><span class="text-gray-500">Duration</span><span class="font-medium">{{ $sermon->duration_formatted }}</span></div>
                        @endif
                        @if($sermon->view_count)
                        <div class="flex justify-between"><span class="text-gray-500">Views</span><span class="font-medium">{{ number_format($sermon->view_count) }}</span></div>
                        @endif
                    </div>
                    @if($sermon->notes_pdf)
                    <a href="{{ asset('storage/' . $sermon->notes_pdf) }}" target="_blank" class="flex items-center gap-2 w-full py-3 px-4 border border-blue-200 text-blue-700 font-medium rounded-xl hover:bg-blue-50 transition-colors text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Download Notes
                    </a>
                    @endif
                    <a href="{{ route('sermons.index') }}" class="block w-full text-center py-3 text-sm text-blue-700 font-medium rounded-xl border border-blue-200 hover:bg-blue-50 transition-colors">
                        All Sermons
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
