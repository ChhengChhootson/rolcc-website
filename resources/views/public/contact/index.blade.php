@extends('layouts.app')

@section('title', 'Contact Us — ROLCC Cambodia')
@section('description', 'Get in touch with ROLCC Cambodia. Find our address, phone number, service times, and send us a message.')

@section('content')

{{-- Hero --}}
<section class="py-20" style="background: linear-gradient(135deg, #082032 0%, #0B4F8C 100%);">
    <div class="container mx-auto px-4 text-center">
        <p class="text-yellow-400 text-sm font-semibold uppercase tracking-widest mb-3">GET IN TOUCH</p>
        <h1 class="text-4xl md:text-5xl font-bold text-white" style="font-family: Poppins">Contact Us</h1>
        <p class="text-blue-200 text-lg mt-4 max-w-xl mx-auto">We'd love to hear from you. Reach out to us anytime.</p>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-16 max-w-6xl mx-auto">

            {{-- Contact Info --}}
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-8" style="font-family: Poppins">Church Information</h2>
                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, #0B4F8C, #3C8DDB);">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Address</h3>
                            <p class="text-gray-600 mt-1">{{ config('church.address', 'Phnom Penh, Cambodia') }}</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, #D4A017, #f59e0b);">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Phone</h3>
                            <p class="text-gray-600 mt-1">{{ config('church.phone', '+855 12 345 678') }}</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, #145DA0, #3C8DDB);">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">Email</h3>
                            <p class="text-gray-600 mt-1">{{ config('church.email', 'info@rolcccambodia.org') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Service Times --}}
                <div class="mt-10 p-6 rounded-2xl" style="background: #f0f7ff;">
                    <h3 class="font-bold text-gray-900 mb-4" style="font-family: Poppins">Service Times</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between"><span class="text-gray-600">Sunday English Service</span><span class="font-medium text-blue-700">9:00 AM</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">Sunday Khmer Service</span><span class="font-medium text-blue-700">11:30 AM</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">Wednesday Prayer</span><span class="font-medium text-blue-700">7:00 PM</span></div>
                    </div>
                </div>
            </div>

            {{-- Contact Form --}}
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-8" style="font-family: Poppins">Send us a Message</h2>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                    @csrf
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Full Name *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                            @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email Address *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                        @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Subject *</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                        @error('subject') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Message *</label>
                        <textarea name="message" rows="5" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition resize-none">{{ old('message') }}</textarea>
                        @error('message') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <button type="submit"
                        class="w-full py-3 px-6 font-bold text-white rounded-xl transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg"
                        style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">
                        Send Message
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

@endsection
