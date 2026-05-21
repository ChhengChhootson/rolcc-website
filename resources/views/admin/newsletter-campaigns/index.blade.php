@extends('layouts.admin')
@section('title', 'Newsletter Campaigns')
@section('content')
<div class="flex items-center justify-between mb-8"><h1 class="text-2xl font-bold text-gray-900">Campaigns</h1><a href="{{ route('admin.newsletter-campaigns.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-white font-semibold rounded-xl text-sm hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">New Campaign</a></div>
@if(session('success'))<div class="mb-5 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>@endif
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
    <table class="w-full text-sm"><thead class="bg-gray-50 border-b border-gray-200"><tr><th class="text-left px-5 py-4 font-semibold text-gray-600">Subject</th><th class="text-left px-5 py-4 font-semibold text-gray-600">Status</th><th class="text-left px-5 py-4 font-semibold text-gray-600">Recipients</th><th class="text-left px-5 py-4 font-semibold text-gray-600">Scheduled</th><th class="text-right px-5 py-4 font-semibold text-gray-600">Actions</th></tr></thead>
    <tbody class="divide-y divide-gray-100">
        @forelse($campaigns as $c)
        <tr class="hover:bg-gray-50">
            <td class="px-5 py-4 font-medium text-gray-900">{{ $c->subject }}</td>
            <td class="px-5 py-4"><span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold {{ $c->status === 'sent' ? 'bg-green-100 text-green-700' : ($c->status === 'sending' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600') }}">{{ ucfirst($c->status) }}</span></td>
            <td class="px-5 py-4 text-gray-600">{{ $c->recipients_count ?? '—' }}</td>
            <td class="px-5 py-4 text-gray-500 text-xs">{{ $c->scheduled_at?->format('M j, Y g:i A') ?? 'Immediate' }}</td>
            <td class="px-5 py-4 text-right"><form method="POST" action="{{ route('admin.newsletter-campaigns.destroy',$c) }}" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="p-2 text-red-500 hover:bg-red-50 rounded-lg"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button></form></td>
        </tr>
        @empty<tr><td colspan="5" class="px-5 py-12 text-center text-gray-400">No campaigns yet.</td></tr>@endforelse
    </tbody></table>
</div>
@endsection