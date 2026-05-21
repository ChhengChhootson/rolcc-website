@extends('layouts.app')
@section('title', 'Registration Successful — ROLCC Cambodia')
@section('content')
<section class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-lg mx-auto text-center">
            <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 bg-green-100">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-3" style="font-family: Poppins">You're Registered!</h1>
            <p class="text-gray-500 mb-8">Thank you for registering. A confirmation has been sent to your email.</p>
            @if(isset($registration))
            <div class="p-5 bg-gray-50 rounded-xl text-sm text-left mb-8 space-y-2">
                <div class="flex justify-between"><span class="text-gray-500">Ticket Number:</span><span class="font-mono font-bold text-blue-700">{{ $registration->ticket_number }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Event:</span><span class="font-medium">{{ $registration->event->title }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Date:</span><span>{{ $registration->event->start_date->format('F j, Y') }}</span></div>
            </div>
            @endif
            <div class="flex gap-3 justify-center">
                <a href="{{ route('events.index') }}" class="px-6 py-3 border border-blue-200 text-blue-700 font-semibold rounded-xl hover:bg-blue-50 transition-colors">All Events</a>
                <a href="{{ route('home') }}" class="px-6 py-3 text-white font-semibold rounded-xl transition-colors" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Go Home</a>
            </div>
        </div>
    </div>
</section>
@endsection
