@extends('layouts.admin')
@section('title', 'Prayer Requests')
@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Prayer Requests</h1>
    <div class="flex gap-3">
        @foreach(['all' => 'All', 'pending' => 'Pending', 'praying' => 'Praying', 'answered' => 'Answered'] as $val => $label)
        <a href="{{ route('admin.prayers.index', ['status' => $val == 'all' ? null : $val]) }}"
            class="px-4 py-2 rounded-xl text-sm font-medium border transition-colors {{ request('status', 'all') == $val ? 'bg-blue-700 text-white border-blue-700' : 'border-gray-300 text-gray-600 hover:bg-gray-50' }}">
            {{ $label }} @if(isset($stats[$val])) <span class="ml-1">({{ $stats[$val] }})</span> @endif
        </a>
        @endforeach
    </div>
</div>
@if(session('success'))<div class="mb-5 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>@endif
<div class="space-y-4">
    @forelse($prayers as $prayer)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 {{ $prayer->is_urgent ? 'border-l-4 border-l-red-400' : '' }}">
        <div class="flex items-start justify-between gap-4">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 text-sm font-bold">
                        {{ substr($prayer->is_anonymous ? 'A' : ($prayer->name ?? 'A'), 0, 1) }}
                    </div>
                    <span class="font-semibold text-gray-900">{{ $prayer->is_anonymous ? 'Anonymous' : ($prayer->name ?? 'Anonymous') }}</span>
                    @if($prayer->is_urgent)<span class="px-2 py-0.5 text-xs font-bold text-red-600 bg-red-100 rounded-full">URGENT</span>@endif
                    @if($prayer->is_private)<span class="px-2 py-0.5 text-xs font-bold text-gray-500 bg-gray-100 rounded-full">PRIVATE</span>@endif
                    <span class="text-xs text-gray-400">{{ $prayer->created_at->diffForHumans() }}</span>
                </div>
                @if($prayer->category)
                <span class="inline-block px-2 py-0.5 text-xs text-blue-600 bg-blue-100 rounded-full mb-2">{{ $prayer->category }}</span>
                @endif
                <p class="text-gray-700 text-sm leading-relaxed">{{ $prayer->request }}</p>
                @if($prayer->prayer_count > 0)
                <div class="mt-2 text-xs text-blue-600 font-medium">🙏 {{ $prayer->prayer_count }} {{ Str::plural('prayer', $prayer->prayer_count) }}</div>
                @endif
            </div>
            <div class="flex gap-2 flex-shrink-0">
                <a href="{{ route('admin.prayers.show', $prayer) }}" class="px-3 py-1.5 text-xs font-semibold border border-blue-200 text-blue-700 rounded-lg hover:bg-blue-50 transition-colors">View</a>
                <form method="POST" action="{{ route('admin.prayers.destroy', $prayer) }}" onsubmit="return confirm('Delete?')">
                    @csrf @method('DELETE')
                    <button class="px-3 py-1.5 text-xs font-semibold border border-red-200 text-red-600 rounded-lg hover:bg-red-50 transition-colors">Delete</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-16 text-gray-400">No prayer requests.</div>
    @endforelse
</div>
@if($prayers->hasPages())<div class="mt-6">{{ $prayers->links() }}</div>@endif
@endsection
