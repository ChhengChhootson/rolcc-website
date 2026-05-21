@extends('layouts.app')
@section('title', $ministry->name . ' Ministry — ROLCC Cambodia')
@section('description', Str::limit($ministry->short_description ?? $ministry->description, 160))
@section('content')

<section class="relative py-24 overflow-hidden" style="background: linear-gradient(135deg, #082032 0%, #0B4F8C 100%);">
    @if($ministry->image)
    <div class="absolute inset-0 opacity-20">
        <img src="{{ asset('storage/' . $ministry->image) }}" class="w-full h-full object-cover">
    </div>
    @endif
    <div class="relative container mx-auto px-4 text-center">
        <p class="text-yellow-400 text-sm font-semibold uppercase tracking-widest mb-3">MINISTRY</p>
        <h1 class="text-4xl md:text-5xl font-bold text-white" style="font-family: Poppins">{{ $ministry->name }}</h1>
        @if($ministry->tagline)
        <p class="text-blue-200 text-xl mt-4">{{ $ministry->tagline }}</p>
        @endif
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-12 max-w-6xl mx-auto">
            <div class="lg:col-span-2">
                <div class="prose prose-lg max-w-none text-gray-700">
                    {!! $ministry->description !!}
                </div>
            </div>
            <div>
                <div class="bg-gray-50 rounded-2xl p-6 space-y-5 sticky top-24">
                    <h3 class="font-bold text-gray-900" style="font-family: Poppins">Ministry Info</h3>
                    @if($ministry->meeting_schedule)
                    <div class="flex items-start gap-3 text-sm">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div><div class="font-medium text-gray-700">Meets</div><div class="text-gray-500">{{ $ministry->meeting_schedule }}</div></div>
                    </div>
                    @endif
                    @if($ministry->contact_email)
                    <div class="flex items-start gap-3 text-sm">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <div><div class="font-medium text-gray-700">Contact</div><a href="mailto:{{ $ministry->contact_email }}" class="text-blue-600">{{ $ministry->contact_email }}</a></div>
                    </div>
                    @endif
                    <a href="{{ route('contact') }}" class="block w-full text-center py-3 text-white font-bold rounded-xl transition-all hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">
                        Get Involved
                    </a>
                    <a href="{{ route('ministries.index') }}" class="block w-full text-center py-3 text-blue-700 font-medium rounded-xl border border-blue-200 hover:bg-blue-50 transition-colors text-sm">
                        All Ministries
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@if(isset($otherMinistries) && $otherMinistries->count())
<section class="py-14" style="background: #f8faff;">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-900 text-center mb-10" style="font-family: Poppins">Other Ministries</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-5xl mx-auto">
            @foreach($otherMinistries as $other)
            <a href="{{ route('ministries.show', $other->slug) }}" class="group text-center p-5 bg-white rounded-2xl border border-gray-100 hover:border-blue-200 hover:shadow-lg transition-all">
                @if($other->image)
                    <div class="w-16 h-16 rounded-full overflow-hidden mx-auto mb-3"><img src="{{ asset('storage/' . $other->image) }}" class="w-full h-full object-cover"></div>
                @else
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3 text-2xl" style="background: linear-gradient(135deg, #0B4F8C, #3C8DDB)">{{ $other->icon ?? '✝' }}</div>
                @endif
                <div class="font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">{{ $other->name }}</div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
