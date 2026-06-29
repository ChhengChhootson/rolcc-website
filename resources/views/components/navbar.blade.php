@php
    $linkClass   = 'text-[13px] font-medium text-white/80 hover:text-white transition-colors duration-150';
    $activeClass = 'text-[13px] font-semibold text-white';
@endphp

<nav id="main-navbar"
     class="fixed top-0 left-0 right-0 z-50 bg-[#04101c] border-b border-white/[0.07]"
     x-data="{ mobileOpen: false, ministriesOpen: false }">

    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-[72px]">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0 group">
                <img src="{{ asset('images/logo.png') }}"
                     alt="ROLCC"
                     class="h-10 w-auto">
                <div class="hidden sm:block leading-none">
                    <div class="font-heading font-bold text-white text-[13.5px] tracking-wide group-hover:text-church-gold transition-colors duration-200">
                        ROLCC Cambodia
                    </div>
                    <div class="text-[10px] text-sky-blue font-medium uppercase tracking-[0.13em] mt-1">
                        River of Life Christian Church
                    </div>
                </div>
            </a>

            {{-- Desktop Navigation --}}
            <ul class="hidden lg:flex items-center gap-7 xl:gap-8">
                <li>
                    <a href="{{ route('home') }}"
                       class="{{ request()->routeIs('home') ? $activeClass : $linkClass }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('about') }}"
                       class="{{ request()->routeIs('about') ? $activeClass : $linkClass }}">
                        About
                    </a>
                </li>

                {{-- Ministries Dropdown --}}
                <li class="relative" @mouseenter="ministriesOpen = true" @mouseleave="ministriesOpen = false">
                    <a href="{{ route('ministries.index') }}"
                       class="{{ request()->routeIs('ministries.*') ? $activeClass : $linkClass }} inline-flex items-center gap-1">
                        Ministries
                        <svg class="w-3 h-3 opacity-50 transition-transform duration-200 mt-px"
                             :class="ministriesOpen ? 'rotate-180' : ''"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                    <div x-show="ministriesOpen"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute top-full left-1/2 -translate-x-1/2 mt-2 w-52 bg-[#04101c]/98 backdrop-blur-2xl border border-white/10 rounded-xl shadow-church-lg py-1.5 overflow-hidden"
                         style="display: none;">
                        @php $navMinistries = \App\Models\Ministry::active()->orderBy('order')->limit(8)->get(); @endphp
                        @foreach($navMinistries as $ministry)
                        <a href="{{ route('ministries.show', $ministry->slug) }}"
                           class="block px-4 py-2.5 text-[12.5px] text-white/75 hover:text-white hover:bg-white/5 transition-colors font-medium">
                            {{ $ministry->name }}
                        </a>
                        @endforeach
                        <div class="h-px bg-white/[0.08] mx-3 my-1"></div>
                        <a href="{{ route('ministries.index') }}"
                           class="block px-4 py-2.5 text-[12.5px] text-sky-blue hover:text-white hover:bg-white/5 transition-colors font-semibold">
                            All Ministries →
                        </a>
                    </div>
                </li>

                <li>
                    <a href="{{ route('sermons.index') }}"
                       class="{{ request()->routeIs('sermons.*') ? $activeClass : $linkClass }}">
                        Sermons
                    </a>
                </li>
                <li>
                    <a href="{{ route('events.index') }}"
                       class="{{ request()->routeIs('events.*') ? $activeClass : $linkClass }}">
                        Events
                    </a>
                </li>
                <li>
                    <a href="{{ route('gallery.index') }}"
                       class="{{ request()->routeIs('gallery.*') ? $activeClass : $linkClass }}">
                        Gallery
                    </a>
                </li>
                <li>
                    <a href="{{ route('blog.index') }}"
                       class="{{ request()->routeIs('blog.*') ? $activeClass : $linkClass }}">
                        Blog
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact') }}"
                       class="{{ request()->routeIs('contact') ? $activeClass : $linkClass }}">
                        Contact
                    </a>
                </li>
            </ul>

            {{-- Desktop CTA --}}
            <div class="hidden lg:flex items-center gap-5">
                @php $isLive = \App\Models\Livestream::live()->exists(); @endphp
                @if($isLive)
                <a href="{{ route('livestream') }}"
                   class="inline-flex items-center gap-1.5 text-[12px] font-bold text-red-400 hover:text-red-300 transition-colors uppercase tracking-widest">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                    </span>
                    Live
                </a>
                @endif

                <a href="{{ route('prayer.index') }}"
                   class="text-[13px] font-medium text-white/90 hover:text-white transition-colors">
                    Prayer
                </a>

                <a href="{{ route('donate') }}"
                   class="inline-flex items-center gap-1.5 bg-church-gold hover:bg-amber-400 text-dark-navy font-semibold text-[13px] px-5 py-2.5 rounded-lg transition-all duration-200">
                    Give Now
                </a>
            </div>

            {{-- Mobile Toggle --}}
            <button @click="mobileOpen = !mobileOpen"
                    class="lg:hidden flex flex-col justify-center items-center gap-[5px] w-9 h-9 focus:outline-none shrink-0"
                    aria-label="Toggle menu">
                <span class="block w-[22px] h-[1.5px] bg-white rounded-full transition-all duration-300"
                      :class="mobileOpen ? 'rotate-45 translate-y-[6.5px]' : ''"></span>
                <span class="block w-[22px] h-[1.5px] bg-white rounded-full transition-all duration-300"
                      :class="mobileOpen ? 'opacity-0 scale-x-0' : ''"></span>
                <span class="block w-[22px] h-[1.5px] bg-white rounded-full transition-all duration-300"
                      :class="mobileOpen ? '-rotate-45 -translate-y-[6.5px]' : ''"></span>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         class="lg:hidden bg-[#04101c]/97 backdrop-blur-2xl border-t border-white/[0.07]"
         style="display: none;">
        <div class="max-w-7xl mx-auto px-5 py-4 space-y-0.5">
            @foreach([
                ['home',             'home',          'Home'],
                ['about',            'about',         'About'],
                ['ministries.index', 'ministries.*',  'Ministries'],
                ['sermons.index',    'sermons.*',     'Sermons'],
                ['events.index',     'events.*',      'Events'],
                ['gallery.index',    'gallery.*',     'Gallery'],
                ['blog.index',       'blog.*',        'Blog'],
                ['prayer.index',     'prayer.*',      'Prayer'],
                ['contact',          'contact',       'Contact'],
            ] as [$routeName, $routePattern, $label])
            <a href="{{ route($routeName) }}"
               class="block py-3 px-1 border-b border-white/[0.05] last:border-0 transition-colors
                      {{ request()->routeIs($routePattern)
                            ? 'text-[13.5px] font-semibold text-white'
                            : 'text-[13.5px] font-medium text-white/90 hover:text-white' }}"
               @click="mobileOpen = false">
                {{ $label }}
            </a>
            @endforeach
            <div class="pt-4 pb-2">
                <a href="{{ route('donate') }}"
                   class="block text-center text-[13.5px] font-semibold bg-church-gold hover:bg-amber-400 text-dark-navy py-3.5 rounded-lg transition-colors"
                   @click="mobileOpen = false">
                    Give Now
                </a>
            </div>
        </div>
    </div>
</nav>
