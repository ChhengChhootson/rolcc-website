@extends('layouts.admin')
@section('title', 'Activity Logs')
@section('content')
<div class="mb-8"><h1 class="text-2xl font-bold text-gray-900">Activity Logs</h1><p class="text-gray-500 text-sm mt-1">Audit trail of all admin actions.</p></div>
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
    <table class="w-full text-sm"><thead class="bg-gray-50 border-b border-gray-200"><tr><th class="text-left px-5 py-4 font-semibold text-gray-600">User</th><th class="text-left px-5 py-4 font-semibold text-gray-600">Action</th><th class="text-left px-5 py-4 font-semibold text-gray-600">Subject</th><th class="text-left px-5 py-4 font-semibold text-gray-600">Time</th></tr></thead>
    <tbody class="divide-y divide-gray-100">
        @forelse($logs as $log)
        <tr class="hover:bg-gray-50">
            <td class="px-5 py-4"><div class="font-medium text-gray-900">{{ $log->causer?->name ?? 'System' }}</div></td>
            <td class="px-5 py-4"><span class="px-2 py-0.5 text-xs rounded-md bg-blue-100 text-blue-700">{{ $log->event }}</span> <span class="text-gray-500">{{ $log->description }}</span></td>
            <td class="px-5 py-4 text-gray-500 text-xs">{{ $log->subject_type ? class_basename($log->subject_type) : '—' }} #{{ $log->subject_id }}</td>
            <td class="px-5 py-4 text-gray-400 text-xs">{{ $log->created_at->format('M j, Y g:i A') }}</td>
        </tr>
        @empty<tr><td colspan="4" class="px-5 py-12 text-center text-gray-400">No activity logged yet.</td></tr>@endforelse
    </tbody></table>
</div>
@if($logs->hasPages())<div class="mt-5">{{ $logs->links() }}</div>@endif
@endsection