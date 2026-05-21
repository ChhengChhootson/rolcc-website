<nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" id="main-navbar"
     x-data="{ scrolled: false, mobileOpen: false, activeDropdown: null }"
     x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 60)"
     :class="scrolled ? 'bg-dark-navy/95 backdrop-blur-md shadow-church-lg py-2' : 'bg-transparent py-4'">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('images/logo.png') }}"
                     alt="ROLCC Cambodia"
                     class="h-12 w-auto transition-all duration-300"
                     :class="scrolled ? 'h-10' : 'h-12'">
                <div class="hidden sm:block">
                    <div class="text-white font-heading font-bold text-base leading-tight group-hover:text-church-gold transition-colors">
                        ROLCC Cambodia
                    </div>
                    <div class="text-sky-blue text-xs font-medium">River of Life Christian Church</div>
                </div>
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center gap-1">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'nav-link-active' : '' }}">About</a>

                {{-- Ministries Dropdown --}}
                <div class="relative" @mouseenter="activeDropdown = 'ministries'" @mouseleave="activeDropdown = null">
                    <a href="{{ route('ministries.index') }}" class="nav-link {{ request()->routeIs('ministries.*') ? 'nav-link-active' : '' }} flex items-center gap-1">
                        Ministries
                        <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="activeDropdown === 'ministries' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </a>
                    <div x-show="activeDropdown === 'ministries'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute top-full left-0 mt-2 w-56 bg-dark-navy/95 backdrop-blur-md rounded-2xl shadow-church-lg border border-white/10 py-2 z-50">
                        @php
                            $navMinistries = \App\Models\Ministry::active()->orderBy('order')->limit(8)->get();
                        @endphp
                        @foreach($navMinistries as $ministry)
                        <a href="{{ route('ministries.show', $ministry->slug) }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-white/10 transition-colors">
                            <span class="w-2 h-2 rounded-full bg-church-gold flex-shrink-0"></span>
                            {{ $ministry->name }}
                        </a>
                        @endforeach
                        <div class="border-t border-white/10 mt-2 pt-2">
                            <a href="{{ route('ministries.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-sky-blue hover:text-white transition-colors">
                                View All Ministries →
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('sermons.index') }}" class="nav-link {{ request()->routeIs('sermons.*') ? 'nav-link-active' : '' }}">Sermons</a>
                <a href="{{ route('events.index') }}" class="nav-link {{ request()->routeIs('events.*') ? 'nav-link-active' : '' }}">Events</a>
                <a href="{{ route('gallery.index') }}" class="nav-link {{ request()->routeIs('gallery.*') ? 'nav-link-active' : '' }}">Gallery</a>
                <a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.*') ? 'nav-link-active' : '' }}">Blog</a>
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'nav-link-active' : '' }}">Contact</a>
            </div>

            {{-- CTA Buttons --}}
            <div class="hidden lg:flex items-center gap-3">
                {{-- Live Badge --}}
                @php $isLive = \App\Models\Livestream::live()->exists(); @endphp
                @if($isLive)
                <a href="{{ route('livestream') }}" class="flex items-center gap-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold px-3 py-1.5 rounded-full transition-colors animate-pulse-soft">
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>LIVE
                </a>
                @endif

                <a href="{{ route('prayer.index') }}" class="text-gray-300 hover:text-white text-sm font-medium transition-colors">Prayer</a>
                <a href="{{ route('donate') }}" class="bg-gradient-to-r from-church-gold to-amber-500 hover:from-amber-500 hover:to-church-gold text-dark-navy font-bold text-sm px-5 py-2.5 rounded-full transition-all duration-300 shadow-gold hover:shadow-glow-gold">
                    Give Now
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <button @click="mobileOpen = !mobileOpen"
                    class="lg:hidden w-10 h-10 flex items-center justify-center text-white hover:text-church-gold transition-colors"
                    aria-label="Toggle menu">
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="lg:hidden bg-dark-navy/98 backdrop-blur-md border-t border-white/10 mt-2">
        <div class="px-4 py-4 space-y-1">
            <a href="{{ route('home') }}" class="mobile-nav-link" @click="mobileOpen = false">Home</a>
            <a href="{{ route('about') }}" class="mobile-nav-link" @click="mobileOpen = false">About</a>
            <a href="{{ route('ministries.index') }}" class="mobile-nav-link" @click="mobileOpen = false">Ministries</a>
            <a href="{{ route('sermons.index') }}" class="mobile-nav-link" @click="mobileOpen = false">Sermons</a>
            <a href="{{ route('events.index') }}" class="mobile-nav-link" @click="mobileOpen = false">Events</a>
            <a href="{{ route('gallery.index') }}" class="mobile-nav-link" @click="mobileOpen = false">Gallery</a>
            <a href="{{ route('blog.index') }}" class="mobile-nav-link" @click="mobileOpen = false">Blog</a>
            <a href="{{ route('prayer.index') }}" class="mobile-nav-link" @click="mobileOpen = false">Prayer</a>
            <a href="{{ route('contact') }}" class="mobile-nav-link" @click="mobileOpen = false">Contact</a>
            <div class="pt-3 pb-2">
                <a href="{{ route('donate') }}" class="w-full block text-center bg-gradient-to-r from-church-gold to-amber-500 text-dark-navy font-bold text-sm px-5 py-3 rounded-full" @click="mobileOpen = false">
                    Give Now
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
.nav-link {
    @apply text-gray-300 hover:text-white text-sm font-medium px-3 py-2 rounded-lg transition-all duration-200 hover:bg-white/10;
}
.nav-link-active {
    @apply text-white bg-white/10;
}
.mobile-nav-link {
    @apply block text-gray-300 hover:text-white hover:bg-white/10 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200;
}
</style>
