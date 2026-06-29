<footer class="bg-[#04101c] text-white">

    {{-- Main footer --}}
    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

            {{-- Brand --}}
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-3 mb-5 group">
                    <img src="{{ asset('images/logo.png') }}" alt="ROLCC Cambodia" class="h-12 w-auto">
                    <div>
                        <div class="font-heading font-bold text-white text-[13.5px] group-hover:text-church-gold transition-colors">ROLCC Cambodia</div>
                        <div class="text-[10px] text-sky-blue/60 uppercase tracking-widest mt-0.5">River of Life Christian Church</div>
                    </div>
                </a>
                <p class="text-white/40 text-[13.5px] leading-relaxed mb-6">
                    Transforming lives and impacting nations through the power of the Gospel of Jesus Christ.
                </p>

                {{-- Socials --}}
                <div class="flex items-center gap-2.5">
                    @if(config('church.social.facebook'))
                    <a href="{{ config('church.social.facebook') }}" target="_blank" rel="noopener noreferrer"
                       class="w-9 h-9 bg-white/[0.07] hover:bg-church-blue rounded-lg flex items-center justify-center text-white/50 hover:text-white transition-all duration-200"
                       aria-label="Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    @endif
                    @if(config('church.social.youtube'))
                    <a href="{{ config('church.social.youtube') }}" target="_blank" rel="noopener noreferrer"
                       class="w-9 h-9 bg-white/[0.07] hover:bg-red-600 rounded-lg flex items-center justify-center text-white/50 hover:text-white transition-all duration-200"
                       aria-label="YouTube">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    @endif
                    @if(config('church.social.instagram'))
                    <a href="{{ config('church.social.instagram') }}" target="_blank" rel="noopener noreferrer"
                       class="w-9 h-9 bg-white/[0.07] hover:bg-pink-600 rounded-lg flex items-center justify-center text-white/50 hover:text-white transition-all duration-200"
                       aria-label="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                    </a>
                    @endif
                    @if(config('church.social.telegram'))
                    <a href="{{ config('church.social.telegram') }}" target="_blank" rel="noopener noreferrer"
                       class="w-9 h-9 bg-white/[0.07] hover:bg-sky-500 rounded-lg flex items-center justify-center text-white/50 hover:text-white transition-all duration-200"
                       aria-label="Telegram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-[11px] font-bold text-white/30 uppercase tracking-[0.15em] mb-5">Quick Links</h4>
                <ul class="space-y-3">
                    @foreach([
                        ['about', 'About Us'],
                        ['ministries.index', 'Ministries'],
                        ['sermons.index', 'Sermons'],
                        ['events.index', 'Events'],
                        ['gallery.index', 'Gallery'],
                        ['blog.index', 'Blog'],
                        ['donate', 'Give / Donate'],
                    ] as [$routeName, $label])
                    <li>
                        <a href="{{ route($routeName) }}"
                           class="text-[13.5px] text-white/45 hover:text-white transition-colors duration-150">
                            {{ $label }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Service Times --}}
            <div>
                <h4 class="text-[11px] font-bold text-white/30 uppercase tracking-[0.15em] mb-5">Service Times</h4>
                <ul class="space-y-4">
                    @foreach(config('church.service_times') as $service)
                    <li>
                        <div class="text-white text-[13.5px] font-medium">{{ $service['name'] }}</div>
                        <div class="text-white/35 text-[12.5px] mt-0.5">{{ $service['day'] }} · {{ $service['time'] }}</div>
                    </li>
                    @endforeach
                </ul>

                <div class="mt-7 p-4 bg-white/[0.05] border border-white/[0.08] rounded-xl">
                    <div class="text-[11px] text-white/30 uppercase tracking-wider mb-1">Location</div>
                    <div class="text-[13.5px] text-white font-medium">{{ config('church.address') }}</div>
                    <a href="https://maps.google.com" target="_blank" rel="noopener noreferrer"
                       class="text-[12px] text-sky-blue/70 hover:text-sky-blue mt-1.5 inline-block transition-colors">
                        View on Maps →
                    </a>
                </div>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="text-[11px] font-bold text-white/30 uppercase tracking-[0.15em] mb-5">Contact Us</h4>
                <p class="text-white/40 text-[13.5px] leading-relaxed mb-6">We'd love to hear from you. Reach out any time.</p>

                <div class="space-y-3">
                    <div class="flex items-center gap-2.5 text-[13px] text-white/50">
                        <svg class="w-3.5 h-3.5 text-church-gold/60 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        {{ config('church.phone') }}
                    </div>
                    <div class="flex items-center gap-2.5 text-[13px] text-white/50">
                        <svg class="w-3.5 h-3.5 text-church-gold/60 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        {{ config('church.email') }}
                    </div>
                    <div class="flex items-start gap-2.5 text-[13px] text-white/50">
                        <svg class="w-3.5 h-3.5 text-church-gold/60 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ config('church.address') }}
                    </div>
                </div>

                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-1.5 mt-6 text-[12.5px] font-semibold text-sky-blue/70 hover:text-sky-blue transition-colors">
                    Send us a message →
                </a>
            </div>
        </div>
    </div>

    {{-- Bottom bar --}}
    <div class="border-t border-white/[0.07]">
        <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-[12.5px] text-white/25">
                &copy; {{ date('Y') }} {{ config('church.name') }}. All rights reserved.
            </p>
            <div class="flex items-center gap-5 text-[12.5px] text-white/25">
                <a href="/privacy-policy" class="hover:text-white/50 transition-colors">Privacy Policy</a>
                <a href="/terms" class="hover:text-white/50 transition-colors">Terms of Service</a>
                @auth
                @if(auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="text-sky-blue/60 hover:text-sky-blue transition-colors">Admin</a>
                @endif
                @endauth
            </div>
        </div>
    </div>
</footer>
