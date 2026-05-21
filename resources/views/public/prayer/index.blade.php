@extends('layouts.app')
@section('title', 'Prayer Requests — ROLCC Cambodia')
@section('description', 'Submit a prayer request to ROLCC Cambodia. We believe in the power of prayer.')
@section('content')

<section class="py-20" style="background: linear-gradient(135deg, #082032 0%, #0B4F8C 100%);">
    <div class="container mx-auto px-4 text-center">
        <p class="text-yellow-400 text-sm font-semibold uppercase tracking-widest mb-3">WE CARE</p>
        <h1 class="text-4xl md:text-5xl font-bold text-white" style="font-family: Poppins">Prayer Requests</h1>
        <p class="text-blue-200 text-lg mt-4 max-w-xl mx-auto">Share your heart with us. Our prayer team stands ready to intercede for you.</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-16 max-w-5xl mx-auto">

            {{-- Submit Form --}}
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6" style="font-family: Poppins">Submit a Prayer Request</h2>

                @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
                    {{ session('success') }}
                </div>
                @endif

                <form method="POST" action="{{ route('prayer.store') }}" class="space-y-5" x-data="{ anonymous: false }">
                    @csrf
                    <div class="flex items-center gap-3 p-4 rounded-xl border cursor-pointer" :class="anonymous ? 'border-blue-400 bg-blue-50' : 'border-gray-200 bg-gray-50'" @click="anonymous = !anonymous">
                        <div class="w-5 h-5 rounded border-2 flex items-center justify-center transition-colors" :class="anonymous ? 'bg-blue-600 border-blue-600' : 'border-gray-400 bg-white'">
                            <svg x-show="anonymous" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <input type="hidden" name="is_anonymous" :value="anonymous ? '1' : '0'">
                        <span class="text-sm font-medium text-gray-700">Submit anonymously</span>
                    </div>

                    <div x-show="!anonymous" class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Your Name</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Category</label>
                        <select name="category" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                            @foreach(['Health', 'Family', 'Finance', 'Salvation', 'Spiritual Growth', 'Work/Career', 'Relationships', 'Other'] as $cat)
                            <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Your Prayer Request *</label>
                        <textarea name="request" rows="5" required placeholder="Share your prayer request here..." class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition resize-none">{{ old('request') }}</textarea>
                        @error('request') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_private" value="1" class="rounded border-gray-300 text-blue-600">
                        <span class="text-sm text-gray-600">Keep this request private (only visible to prayer team)</span>
                    </label>

                    <button type="submit" class="w-full py-3 text-white font-bold rounded-xl transition-all hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">
                        Submit Prayer Request
                    </button>
                </form>
            </div>

            {{-- Why We Pray + Public Requests --}}
            <div>
                <div class="p-6 rounded-2xl mb-8" style="background: linear-gradient(135deg, #f0f7ff, #e8f4fd);">
                    <div class="text-4xl mb-4">🙏</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3" style="font-family: Poppins">Why We Pray Together</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">"For where two or three gather in my name, there am I with them." — Matthew 18:20</p>
                    <p class="text-gray-600 text-sm leading-relaxed">Our dedicated prayer team reviews every request and prays faithfully. You are never alone in your journey.</p>
                </div>

                @if(isset($publicRequests) && $publicRequests->count())
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-5" style="font-family: Poppins">Community Prayer Wall</h3>
                    <div class="space-y-4">
                        @foreach($publicRequests as $prayer)
                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <div class="w-6 h-6 rounded-full bg-blue-600 text-white text-xs flex items-center justify-center font-bold">
                                            {{ substr($prayer->is_anonymous ? 'A' : ($prayer->name ?? 'A'), 0, 1) }}
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">{{ $prayer->is_anonymous ? 'Anonymous' : ($prayer->name ?? 'Anonymous') }}</span>
                                        <span class="text-xs text-gray-400">· {{ $prayer->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-600 text-sm leading-relaxed">{{ Str::limit($prayer->request, 150) }}</p>
                                </div>
                                <form method="POST" action="{{ route('prayer.pray', $prayer->id) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="flex items-center gap-1 text-xs text-blue-600 hover:text-blue-800 font-medium whitespace-nowrap">
                                        🙏 {{ $prayer->prayer_count ?? 0 }}
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</section>
@endsection
