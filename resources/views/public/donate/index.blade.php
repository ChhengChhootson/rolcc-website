@extends('layouts.app')
@section('title', 'Give — ROLCC Cambodia')
@section('description', 'Support the ministry of ROLCC Cambodia through your generous giving. Every gift makes a difference.')
@section('content')

<section class="py-24" style="background: linear-gradient(135deg, #082032 0%, #0B4F8C 100%);">
    <div class="container mx-auto px-4 text-center">
        <p class="text-yellow-400 text-sm font-semibold uppercase tracking-widest mb-3">GENEROSITY</p>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4" style="font-family: Poppins">Give Generously</h1>
        <p class="text-blue-200 text-lg max-w-2xl mx-auto">"Each of you should give what you have decided in your heart to give, not reluctantly or under compulsion, for God loves a cheerful giver." — 2 Corinthians 9:7</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-12">
                <p class="text-yellow-500 text-sm font-semibold uppercase tracking-widest mb-3">WHERE YOUR GIVING GOES</p>
                <h2 class="text-3xl font-bold text-gray-900" style="font-family: Poppins">Giving Categories</h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-14">
                @foreach($categories ?? [] as $cat)
                <div class="p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-shadow text-center">
                    @if($cat->icon)
                    <div class="text-3xl mb-3">{{ $cat->icon }}</div>
                    @else
                    <div class="w-12 h-12 rounded-full mx-auto mb-3 flex items-center justify-center" style="background: linear-gradient(135deg, #0B4F8C, #3C8DDB)">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    @endif
                    <h3 class="font-bold text-gray-900 mb-2" style="font-family: Poppins">{{ $cat->name }}</h3>
                    @if($cat->description) <p class="text-gray-500 text-sm">{{ $cat->description }}</p> @endif
                    @if($cat->goal_amount)
                    <div class="mt-3 text-xs text-gray-400">Goal: ${{ number_format($cat->goal_amount) }}</div>
                    @endif
                </div>
                @endforeach
            </div>

            <div class="grid lg:grid-cols-2 gap-12">
                {{-- Online Giving --}}
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6" style="font-family: Poppins">Online Giving</h2>
                    <form method="POST" action="{{ route('donate.store') }}" class="space-y-5">
                        @csrf
                        @if(session('success'))
                        <div class="p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>
                        @endif
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Full Name *</label>
                            <input type="text" name="donor_name" value="{{ old('donor_name') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Email *</label>
                            <input type="email" name="donor_email" value="{{ old('donor_email') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Give Towards</label>
                            <select name="donation_category_id" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                                <option value="">General Fund</option>
                                @foreach($categories ?? [] as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Amount (USD) *</label>
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach([10, 20, 50, 100, 200, 500] as $amt)
                                <button type="button" onclick="document.querySelector('[name=amount]').value='{{ $amt }}'"
                                    class="px-4 py-2 border-2 border-blue-200 text-blue-700 rounded-lg font-semibold hover:border-blue-600 hover:bg-blue-50 transition-colors text-sm">
                                    ${{ $amt }}
                                </button>
                                @endforeach
                            </div>
                            <input type="number" name="amount" step="0.01" min="1" value="{{ old('amount') }}" required placeholder="Custom amount"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Payment Method</label>
                            <select name="payment_method" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="aba_pay">ABA Pay</option>
                                <option value="wing">Wing</option>
                                <option value="cash">Cash (In Person)</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full py-4 text-white font-bold text-lg rounded-xl transition-all hover:opacity-90" style="background: linear-gradient(135deg, #D4A017, #f59e0b);">
                            Give Now ❤
                        </button>
                    </form>
                </div>

                {{-- Bank Info --}}
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6" style="font-family: Poppins">Bank Transfer Details</h2>
                    <div class="p-6 bg-gray-50 rounded-2xl space-y-4 text-sm">
                        <div>
                            <div class="font-semibold text-gray-700 mb-1">ABA Bank (USD)</div>
                            <div class="text-gray-600">Account Name: River of Life Christian Church Cambodia</div>
                            <div class="text-gray-600">Account Number: 000 123 456</div>
                        </div>
                        <div class="border-t border-gray-200 pt-4">
                            <div class="font-semibold text-gray-700 mb-1">Acleda Bank (KHR)</div>
                            <div class="text-gray-600">Account Name: ROLCC Cambodia</div>
                            <div class="text-gray-600">Account Number: 123 456 789</div>
                        </div>
                    </div>
                    <div class="mt-6 p-5 rounded-2xl" style="background: linear-gradient(135deg, #f0f7ff, #e8f4fd);">
                        <div class="text-2xl mb-3">🙏</div>
                        <p class="text-gray-700 font-medium mb-2">Every gift matters</p>
                        <p class="text-gray-500 text-sm leading-relaxed">Your generosity helps us reach more people, run more programs, and spread the Gospel throughout Cambodia. Thank you for partnering with us!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
