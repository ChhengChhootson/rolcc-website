@extends('layouts.admin')
@section('title', 'Registrations — ' . $event->title)
@section('content')
<div class="flex items-center gap-3 mb-8">
    <a href="{{ route('admin.events.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a>
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Event Registrations</h1>
        <p class="text-gray-500 text-sm">{{ $event->title }}</p>
    </div>
</div>
<div class="grid grid-cols-3 gap-5 mb-8">
    <div class="bg-white rounded-2xl border border-gray-200 p-5 text-center shadow-sm">
        <div class="text-3xl font-bold text-blue-700">{{ $stats['total'] ?? 0 }}</div>
        <div class="text-gray-500 text-sm mt-1">Total Registered</div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-200 p-5 text-center shadow-sm">
        <div class="text-3xl font-bold text-green-600">{{ $stats['attended'] ?? 0 }}</div>
        <div class="text-gray-500 text-sm mt-1">Attended</div>
    </div>
    <div class="bg-white rounded-2xl border border-gray-200 p-5 text-center shadow-sm">
        <div class="text-3xl font-bold text-gray-500">{{ $event->max_attendees ?? '∞' }}</div>
        <div class="text-gray-500 text-sm mt-1">Capacity</div>
    </div>
</div>
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-5 py-4 font-semibold text-gray-600">Ticket #</th>
                <th class="text-left px-5 py-4 font-semibold text-gray-600">Name</th>
                <th class="text-left px-5 py-4 font-semibold text-gray-600">Email</th>
                <th class="text-left px-5 py-4 font-semibold text-gray-600">Guests</th>
                <th class="text-left px-5 py-4 font-semibold text-gray-600">Status</th>
                <th class="text-right px-5 py-4 font-semibold text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($registrations as $reg)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 font-mono text-xs text-gray-600">{{ $reg->ticket_number }}</td>
                <td class="px-5 py-4 font-medium text-gray-900">{{ $reg->name }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $reg->email }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $reg->guests + 1 }}</td>
                <td class="px-5 py-4">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $reg->attended ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                        {{ $reg->attended ? 'Attended' : 'Registered' }}
                    </span>
                </td>
                <td class="px-5 py-4 text-right">
                    @if(!$reg->attended)
                    <form method="POST" action="{{ route('admin.events.check-in', $reg) }}">
                        @csrf @method('PATCH')
                        <button class="px-3 py-1.5 text-xs font-semibold text-white bg-green-600 hover:bg-green-700 rounded-lg transition-colors">Check In</button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-5 py-12 text-center text-gray-400">No registrations yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
