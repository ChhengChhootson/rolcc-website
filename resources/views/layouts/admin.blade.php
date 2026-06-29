<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | ROLCC Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@500;600;700;800&family=Noto+Sans+Khmer:wght@300;400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    @stack('styles')
</head>
<body class="font-sans bg-gray-50 antialiased"
      x-data="{ sidebarOpen: window.innerWidth >= 1024, sidebarCollapsed: false }">

    <div class="flex h-screen overflow-hidden">

        {{-- ================================================ --}}
        {{-- SIDEBAR --}}
        {{-- ================================================ --}}
        <aside class="fixed inset-y-0 left-0 z-50 flex flex-col bg-dark-navy transition-all duration-300 ease-in-out"
               :class="[
                   sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0',
                   sidebarCollapsed ? 'w-16' : 'w-64'
               ]">

            {{-- Sidebar Header --}}
            <div class="flex items-center justify-between h-16 px-4 border-b border-white/10 flex-shrink-0">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3" x-show="!sidebarCollapsed">
                    <img src="{{ asset('images/logo.png') }}" alt="ROLCC" class="h-8 w-auto">
                    <div>
                        <div class="text-white font-bold text-sm leading-none">ROLCC</div>
                        <div class="text-sky-blue text-xs">Admin Panel</div>
                    </div>
                </a>
                <img src="{{ asset('images/logo.png') }}" alt="ROLCC" class="h-8 w-auto mx-auto" x-show="sidebarCollapsed">
                <button @click="sidebarCollapsed = !sidebarCollapsed" class="text-gray-400 hover:text-white hidden lg:block flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/></svg>
                </button>
            </div>

            {{-- Sidebar Nav --}}
            <nav class="flex-1 overflow-y-auto py-4 px-2 space-y-0.5">
                <x-admin.nav-item route="admin.dashboard" icon="dashboard" label="Dashboard" :collapsed="false"/>

                {{-- Content --}}
                <div x-show="!sidebarCollapsed" class="px-3 pt-4 pb-1">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-widest">Content</span>
                </div>
                <x-admin.nav-item route="admin.sermons.index" icon="video" label="Sermons" :collapsed="false"/>
                <x-admin.nav-item route="admin.events.index" icon="calendar" label="Events" :collapsed="false"/>
                <x-admin.nav-item route="admin.ministries.index" icon="church" label="Ministries" :collapsed="false"/>
                <x-admin.nav-item route="admin.blogs.index" icon="blog" label="Blog Posts" :collapsed="false"/>
                <x-admin.nav-item route="admin.albums.index" icon="gallery" label="Gallery" :collapsed="false"/>
                <x-admin.nav-item route="admin.leadership.index" icon="leaders" label="Leadership" :collapsed="false"/>

                {{-- Communication --}}
                <div x-show="!sidebarCollapsed" class="px-3 pt-4 pb-1">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-widest">Communication</span>
                </div>
                <x-admin.nav-item route="admin.prayers.index" icon="prayer" label="Prayer Requests" badge="{{ \App\Models\PrayerRequest::pending()->count() }}" :collapsed="false"/>
                <x-admin.nav-item route="admin.announcements.index" icon="announcement" label="Announcements" :collapsed="false"/>
                <x-admin.nav-item route="admin.testimonials.index" icon="testimonial" label="Testimonials" :collapsed="false"/>

                {{-- Finance --}}
                <div x-show="!sidebarCollapsed" class="px-3 pt-4 pb-1">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-widest">Finance</span>
                </div>
                <x-admin.nav-item route="admin.donations.index" icon="donation" label="Donations" :collapsed="false"/>

                {{-- System --}}
                <div x-show="!sidebarCollapsed" class="px-3 pt-4 pb-1">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-widest">System</span>
                </div>
                <x-admin.nav-item route="admin.users.index" icon="users" label="Users & Roles" :collapsed="false"/>
                <x-admin.nav-item route="admin.media.index" icon="media" label="Media Library" :collapsed="false"/>
                <x-admin.nav-item route="admin.settings.index" icon="settings" label="Settings" :collapsed="false"/>
                <x-admin.nav-item route="admin.activity-logs.index" icon="logs" label="Activity Logs" :collapsed="false"/>
            </nav>

            {{-- User Profile --}}
            <div class="border-t border-white/10 p-3 flex-shrink-0">
                <div class="flex items-center gap-3" x-show="!sidebarCollapsed">
                    <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full object-cover flex-shrink-0">
                    <div class="min-w-0 flex-1">
                        <div class="text-white text-xs font-semibold truncate">{{ auth()->user()->name }}</div>
                        <div class="text-gray-400 text-xs truncate">{{ auth()->user()->getRoleNames()->first() ?? 'Admin' }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-white transition-colors" title="Logout">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Mobile Overlay --}}
        <div x-show="sidebarOpen && window.innerWidth < 1024"
             @click="sidebarOpen = false"
             class="fixed inset-0 z-40 bg-black/50 lg:hidden"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
        </div>

        {{-- ================================================ --}}
        {{-- MAIN CONTENT --}}
        {{-- ================================================ --}}
        <div class="flex flex-col flex-1 overflow-hidden transition-all duration-300"
             :class="sidebarCollapsed ? 'lg:ml-16' : 'lg:ml-64'">

            {{-- Top Bar --}}
            <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-4 sm:px-6 flex-shrink-0 z-30 shadow-sm">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700 lg:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>

                    {{-- Breadcrumb --}}
                    <div class="hidden sm:flex items-center gap-2 text-sm text-gray-500">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-church-blue transition-colors">Dashboard</a>
                        @hasSection('breadcrumb')
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        @yield('breadcrumb')
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    {{-- Visit Website --}}
                    <a href="{{ route('home') }}" target="_blank" class="text-xs text-gray-500 hover:text-church-blue flex items-center gap-1 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        View Site
                    </a>

                    {{-- Notifications --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="relative w-9 h-9 rounded-lg flex items-center justify-center text-gray-500 hover:bg-gray-100 hover:text-gray-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                            @php $urgentPrayers = \App\Models\PrayerRequest::urgent()->where('status','pending')->count(); @endphp
                            @if($urgentPrayers > 0)
                            <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-bold">{{ $urgentPrayers }}</span>
                            @endif
                        </button>
                    </div>

                    {{-- User --}}
                    <div class="flex items-center gap-2">
                        <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full object-cover ring-2 ring-church-blue/20">
                        <span class="hidden sm:block text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                    </div>
                </div>
            </header>

            {{-- Flash Messages --}}
            @if(session('success'))
            <div class="mx-6 mt-4" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)">
                <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl px-4 py-3 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-green-500 hover:text-green-700"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg></button>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="mx-6 mt-4" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 7000)">
                <div class="bg-red-50 border border-red-200 text-red-800 rounded-xl px-4 py-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
            </div>
            @endif

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto p-4 sm:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
