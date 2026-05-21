@extends('layouts.app')

@section('title', 'About Us — ROLCC Cambodia')
@section('description', 'Learn about River of Life Christian Church Cambodia — our story, mission, vision, and leadership team.')

@section('content')

{{-- Hero --}}
<section class="relative py-24 overflow-hidden" style="background: linear-gradient(135deg, #082032 0%, #0B4F8C 60%, #145DA0 100%);">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('{{ asset('images/church-bg.jpg') }}'); background-size: cover; background-position: center;"></div>
    </div>
    <div class="relative container mx-auto px-4 text-center">
        <p class="text-yellow-400 text-sm font-semibold uppercase tracking-widest mb-3">WHO WE ARE</p>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" style="font-family: Poppins">About ROLCC Cambodia</h1>
        <p class="text-blue-200 text-lg max-w-2xl mx-auto">Building lives, strengthening families, and transforming communities through the power of God's Word.</p>
    </div>
</section>

{{-- Our Story --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-16 items-center max-w-6xl mx-auto">
            <div>
                <p class="text-yellow-500 text-sm font-semibold uppercase tracking-widest mb-3">OUR STORY</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6" style="font-family: Poppins">River of Life Christian Church</h2>
                <div class="space-y-4 text-gray-600 leading-relaxed">
                    <p>River of Life Christian Church Cambodia (ROLCC) was established with a vision to be a lighthouse of hope and transformation in the heart of Phnom Penh. We are a Spirit-filled, Bible-believing community of believers who are passionate about Jesus Christ.</p>
                    <p>Our church is built on the foundation of God's Word, empowered by the Holy Spirit, and committed to making disciples who make disciples. We believe every person has incredible value and purpose in God's kingdom.</p>
                    <p>From humble beginnings, ROLCC has grown into a vibrant, multi-generational church serving thousands of families across Cambodia.</p>
                </div>
            </div>
            <div class="relative">
                <div class="aspect-video rounded-2xl overflow-hidden shadow-2xl">
                    <img src="{{ asset('images/church-building.jpg') }}" alt="ROLCC Church" class="w-full h-full object-cover"
                         onerror="this.parentElement.style.background='linear-gradient(135deg, #0B4F8C, #145DA0)'; this.style.display='none'">
                </div>
                <div class="absolute -bottom-6 -right-6 bg-yellow-500 text-blue-900 font-bold p-6 rounded-xl shadow-xl">
                    <div class="text-3xl font-bold">15+</div>
                    <div class="text-sm">Years of Ministry</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Mission Vision Values --}}
<section class="py-20" style="background: #f8faff;">
    <div class="container mx-auto px-4">
        <div class="text-center mb-14">
            <p class="text-yellow-500 text-sm font-semibold uppercase tracking-widest mb-3">OUR FOUNDATION</p>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900" style="font-family: Poppins">Mission, Vision & Values</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-blue-50 text-center hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5" style="background: linear-gradient(135deg, #0B4F8C, #3C8DDB);">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3" style="font-family: Poppins">Our Mission</h3>
                <p class="text-gray-600">To love God, love people, and make disciples — transforming lives and communities through the Gospel of Jesus Christ.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-blue-50 text-center hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5" style="background: linear-gradient(135deg, #D4A017, #f59e0b);">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3" style="font-family: Poppins">Our Vision</h3>
                <p class="text-gray-600">To be a church where every person encounters God's presence, finds family, and discovers their God-given purpose and calling.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-blue-50 text-center hover:shadow-lg transition-shadow">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5" style="background: linear-gradient(135deg, #145DA0, #3C8DDB);">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3" style="font-family: Poppins">Our Values</h3>
                <p class="text-gray-600">Faith, Family, Community, Integrity, Excellence, and Generosity — these are the core values that guide everything we do.</p>
            </div>
        </div>
    </div>
</section>

{{-- Leadership Team --}}
@if(isset($leadership) && $leadership->count())
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-14">
            <p class="text-yellow-500 text-sm font-semibold uppercase tracking-widest mb-3">MEET THE TEAM</p>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900" style="font-family: Poppins">Our Leadership</h2>
            <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Dedicated servants committed to shepherding the flock and advancing God's Kingdom in Cambodia.</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 max-w-6xl mx-auto">
            @foreach($leadership->flatten() as $leader)
            <div class="text-center group">
                <div class="relative w-40 h-40 mx-auto mb-5">
                    <div class="w-full h-full rounded-full overflow-hidden border-4 border-blue-100 group-hover:border-yellow-400 transition-colors">
                        @if($leader->photo)
                            <img src="{{ asset('storage/' . $leader->photo) }}" alt="{{ $leader->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-white text-3xl font-bold" style="background: linear-gradient(135deg, #0B4F8C, #3C8DDB)">
                                {{ substr($leader->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                </div>
                <h3 class="text-lg font-bold text-gray-900" style="font-family: Poppins">{{ $leader->name }}</h3>
                <p class="text-blue-600 text-sm font-medium">{{ $leader->title }}</p>
                @if($leader->bio)
                    <p class="text-gray-500 text-sm mt-2 leading-relaxed">{{ Str::limit($leader->bio, 100) }}</p>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Service Times --}}
<section class="py-20" style="background: linear-gradient(135deg, #082032 0%, #0B4F8C 100%);">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <p class="text-yellow-400 text-sm font-semibold uppercase tracking-widest mb-3">JOIN US</p>
            <h2 class="text-3xl md:text-4xl font-bold text-white" style="font-family: Poppins">Service Times</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-4xl mx-auto">
            @foreach([
                ['Sunday', 'English Service', '9:00 AM – 11:00 AM', 'Main Sanctuary'],
                ['Sunday', 'Khmer Service', '11:30 AM – 1:00 PM', 'Main Sanctuary'],
                ['Wednesday', 'Midweek Prayer', '7:00 PM – 9:00 PM', 'Prayer Room'],
            ] as $svc)
            <div class="bg-white/10 backdrop-blur border border-white/20 rounded-2xl p-6 text-center hover:bg-white/15 transition-colors">
                <div class="text-yellow-400 text-sm font-semibold uppercase tracking-wider mb-2">{{ $svc[0] }}</div>
                <div class="text-white text-xl font-bold mb-1" style="font-family: Poppins">{{ $svc[1] }}</div>
                <div class="text-blue-200 text-lg">{{ $svc[2] }}</div>
                <div class="text-blue-300 text-sm mt-2">📍 {{ $svc[3] }}</div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-yellow-500 hover:bg-yellow-400 text-blue-900 font-bold rounded-full transition-colors">
                Get Directions
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</section>

@endsection
