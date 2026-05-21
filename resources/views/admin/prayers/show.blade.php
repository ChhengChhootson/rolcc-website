@extends('layouts.admin')
@section('title', 'Prayer Request')
@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.prayers.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a>
        <h1 class="text-2xl font-bold text-gray-900">Prayer Request</h1>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 space-y-5">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-lg">
                {{ substr($prayerRequest->is_anonymous ? 'A' : ($prayerRequest->name ?? 'A'), 0, 1) }}
            </div>
            <div>
                <div class="font-bold text-gray-900">{{ $prayerRequest->is_anonymous ? 'Anonymous' : ($prayerRequest->name ?? 'Anonymous') }}</div>
                @if($prayerRequest->email && !$prayerRequest->is_anonymous)
                <div class="text-sm text-gray-500">{{ $prayerRequest->email }}</div>
                @endif
            </div>
        </div>
        @if($prayerRequest->category)
        <div><span class="text-xs font-semibold uppercase tracking-wide text-gray-500">Category:</span> <span class="text-sm text-gray-700">{{ $prayerRequest->category }}</span></div>
        @endif
        <div>
            <div class="text-xs font-semibold uppercase tracking-wide text-gray-500 mb-2">Prayer Request</div>
            <div class="p-4 bg-gray-50 rounded-xl text-gray-700 leading-relaxed">{{ $prayerRequest->request }}</div>
        </div>
        <div class="grid grid-cols-3 gap-4 text-center text-sm">
            <div class="p-3 bg-blue-50 rounded-xl"><div class="font-bold text-blue-700">{{ $prayerRequest->prayer_count ?? 0 }}</div><div class="text-gray-500 text-xs">Prayers</div></div>
            <div class="p-3 bg-gray-50 rounded-xl"><div class="font-bold text-gray-700">{{ $prayerRequest->status ?? 'pending' }}</div><div class="text-gray-500 text-xs">Status</div></div>
            <div class="p-3 bg-gray-50 rounded-xl"><div class="font-bold text-gray-700">{{ $prayerRequest->created_at->format('M j') }}</div><div class="text-gray-500 text-xs">Submitted</div></div>
        </div>
        <form method="POST" action="{{ route('admin.prayers.update', $prayerRequest) }}" class="flex gap-3">
            @csrf @method('PATCH')
            <select name="status" class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition text-sm">
                @foreach(['pending', 'praying', 'answered'] as $s)
                <option value="{{ $s }}" {{ $prayerRequest->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-6 py-3 text-white font-bold rounded-xl hover:opacity-90 text-sm" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Update Status</button>
        </form>
    </div>
</div>
@endsection
