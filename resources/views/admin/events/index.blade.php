@extends('layouts.admin')
@section('title', 'Events')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Events</h1>
    <a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-white font-semibold rounded-xl text-sm transition-all hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Add Event
    </a>
</div>

@if(session('success'))
<div class="mb-5 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-5 py-4 font-semibold text-gray-600">Event</th>
                <th class="text-left px-5 py-4 font-semibold text-gray-600">Date</th>
                <th class="text-left px-5 py-4 font-semibold text-gray-600">Location</th>
                <th class="text-left px-5 py-4 font-semibold text-gray-600">Registrations</th>
                <th class="text-left px-5 py-4 font-semibold text-gray-600">Status</th>
                <th class="text-right px-5 py-4 font-semibold text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($events as $event)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-5 py-4">
                    <div class="font-semibold text-gray-900">{{ $event->title }}</div>
                    @if($event->is_featured)
                    <span class="inline-block px-2 py-0.5 text-xs bg-yellow-100 text-yellow-700 rounded-full mt-1">Featured</span>
                    @endif
                </td>
                <td class="px-5 py-4 text-gray-600">{{ $event->start_date->format('M j, Y') }}</td>
                <td class="px-5 py-4 text-gray-600">{{ Str::limit($event->location, 30) }}</td>
                <td class="px-5 py-4 text-gray-600">
                    @if($event->requires_registration)
                    <a href="{{ route('admin.events.registrations', $event) }}" class="text-blue-600 hover:underline">
                        {{ $event->registrations_count ?? 0 }} / {{ $event->max_attendees ?? '∞' }}
                    </a>
                    @else
                    <span class="text-gray-400">Open</span>
                    @endif
                </td>
                <td class="px-5 py-4">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $event->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                        {{ ucfirst($event->status) }}
                    </span>
                </td>
                <td class="px-5 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.events.edit', $event) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form method="POST" action="{{ route('admin.events.destroy', $event) }}" onsubmit="return confirm('Delete this event?')">
                            @csrf @method('DELETE')
                            <button class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-5 py-16 text-center text-gray-400">No events yet. Create your first event!</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@if($events->hasPages())
<div class="mt-5">{{ $events->links() }}</div>
@endif
@endsection
