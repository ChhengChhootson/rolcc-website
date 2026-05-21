@extends('layouts.app')
@section('title', 'Unsubscribed — ROLCC Cambodia')
@section('content')
<section class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto text-center">
            <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 bg-gray-100">
                <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-3" style="font-family: Poppins">You've been unsubscribed</h1>
            <p class="text-gray-500 mb-8">You have been successfully removed from our newsletter list. We're sorry to see you go!</p>
            <a href="{{ route('home') }}" class="inline-block px-8 py-3 text-white font-bold rounded-xl" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Back to Home</a>
        </div>
    </div>
</section>
@endsection
