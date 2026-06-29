<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta --}}
    <title>@yield('title', config('church.name')) | {{ config('church.short_name') }}</title>
    <meta name="description" content="@yield('description', config('church.tagline') . ' - ' . config('church.name'))">
    <meta name="keywords" content="@yield('keywords', 'ROLCC Cambodia, church, Christian, Phnom Penh, Cambodia')">
    <meta name="author" content="{{ config('church.name') }}">
    <meta name="robots" content="@yield('robots', 'index, follow')">

    {{-- Open Graph --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', config('church.name'))">
    <meta property="og:description" content="@yield('og_description', config('church.tagline'))">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="{{ config('church.name') }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', config('church.name'))">
    <meta name="twitter:description" content="@yield('twitter_description', config('church.tagline'))">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/og-default.jpg'))">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Nunito+Sans:wght@300;400;600;700;800&family=Noto+Sans+Khmer:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Canonical --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Schema Markup --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Church",
        "name": "{{ config('church.name') }}",
        "url": "{{ config('app.url') }}",
        "logo": "{{ asset('images/logo.png') }}",
        "address": {
            "@@type": "PostalAddress",
            "addressLocality": "Phnom Penh",
            "addressCountry": "KH"
        },
        "telephone": "{{ config('church.phone') }}",
        "email": "{{ config('church.email') }}"
    }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    {{-- Google Analytics --}}
    @if(config('church.analytics.google_id'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('church.analytics.google_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ config('church.analytics.google_id') }}');
    </script>
    @endif
</head>
<body class="font-sans antialiased bg-soft-white text-gray-900" x-data="{ mobileMenuOpen: false }">

    {{-- Loading Screen --}}
    <div id="loading-screen" class="fixed inset-0 z-[9999] flex items-center justify-center bg-dark-navy transition-opacity duration-500">
        <div class="text-center">
            <img src="{{ asset('images/logo.png') }}" alt="ROLCC Cambodia" class="h-16 mx-auto mb-4 animate-pulse-soft">
            <div class="flex justify-center space-x-1">
                <div class="w-2 h-2 bg-church-gold rounded-full animate-bounce" style="animation-delay: 0ms"></div>
                <div class="w-2 h-2 bg-church-gold rounded-full animate-bounce" style="animation-delay: 150ms"></div>
                <div class="w-2 h-2 bg-church-gold rounded-full animate-bounce" style="animation-delay: 300ms"></div>
            </div>
        </div>
    </div>

    {{-- Sticky Navbar --}}
    @include('components.navbar')

    {{-- Live Stream Banner --}}
    @if(isset($live_stream) && $live_stream)
    <div class="bg-gradient-to-r from-red-600 to-red-700 text-white py-2 px-4 text-center text-sm font-medium">
        <span class="inline-flex items-center gap-2">
            <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
            We are LIVE now!
            <a href="{{ route('livestream') }}" class="underline font-bold hover:no-underline">Watch Now →</a>
        </span>
    </div>
    @endif

    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="fixed top-24 right-4 z-50 max-w-sm" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)">
        <div class="bg-church-success text-white rounded-xl p-4 shadow-church-lg flex items-start gap-3">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <p class="text-sm font-medium">{{ session('success') }}</p>
            <button @click="show = false" class="ml-auto opacity-75 hover:opacity-100"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="fixed top-24 right-4 z-50 max-w-sm" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 7000)">
        <div class="bg-church-error text-white rounded-xl p-4 shadow-church-lg flex items-start gap-3">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            <p class="text-sm font-medium">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Back to Top --}}
    <button id="back-to-top"
        class="fixed bottom-8 right-8 z-40 w-12 h-12 bg-church-blue text-white rounded-full shadow-church-lg flex items-center justify-center opacity-0 translate-y-4 transition-all duration-300 hover:bg-royal-blue hover:shadow-glow"
        onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
    </button>

    <script>
        // Loading screen
        window.addEventListener('load', function() {
            const loader = document.getElementById('loading-screen');
            loader.style.opacity = '0';
            setTimeout(() => loader.style.display = 'none', 500);
        });

        // Back to top
        window.addEventListener('scroll', function() {
            const btn = document.getElementById('back-to-top');
            if (window.scrollY > 400) {
                btn.style.opacity = '1';
                btn.style.transform = 'translateY(0)';
            } else {
                btn.style.opacity = '0';
                btn.style.transform = 'translateY(16px)';
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
