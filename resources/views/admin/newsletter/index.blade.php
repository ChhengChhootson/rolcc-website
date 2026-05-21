@extends('layouts.admin')
@section('title', 'Newsletter Subscribers')
@section('content')
<div class="flex items-center justify-between mb-8">
    <div><h1 class="text-2xl font-bold text-gray-900">Newsletter Subscribers</h1><p class="text-gray-500 text-sm mt-1">{{ $activeCount }} active · {{ $totalCount }} total</p></div>
    <a href="{{ route('admin.newsletter.export') }}" class="px-5 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-xl text-sm hover:bg-gray-50">Export CSV</a>
</div>
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200"><tr><th class="text-left px-5 py-4 font-semibold text-gray-600">Email</th><th class="text-left px-5 py-4 font-semibold text-gray-600">Name</th><th class="text-left px-5 py-4 font-semibold text-gray-600">Source</th><th class="text-left px-5 py-4 font-semibold text-gray-600">Status</th><th class="text-left px-5 py-4 font-semibold text-gray-600">Subscribed</th><th class="text-right px-5 py-4 font-semibold text-gray-600">Actions</th></tr></thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($subscribers as $sub)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 font-medium text-gray-900">{{ $sub->email }}</td>
                <td class="px-5 py-4 text-gray-600">{{ $sub->name ?? '—' }}</td>
                <td class="px-5 py-4 text-gray-500 text-xs">{{ $sub->source }}</td>
                <td class="px-5 py-4"><span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold {{ $sub->is_subscribed ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ $sub->is_subscribed ? 'Active' : 'Unsubscribed' }}</span></td>
                <td class="px-5 py-4 text-gray-500 text-xs">{{ $sub->subscribed_at?->format('M j, Y') ?? '—' }}</td>
                <td class="px-5 py-4 text-right"><form method="POST" action="{{ route('admin.newsletter.destroy',$sub) }}" onsubmit="return confirm('Remove?')">@csrf @method('DELETE')<button class="p-2 text-red-500 hover:bg-red-50 rounded-lg"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button></form></td>
            </tr>
            @empty<tr><td colspan="6" class="px-5 py-12 text-center text-gray-400">No subscribers yet.</td></tr>@endforelse
        </tbody>
    </table>
</div>
@if($subscribers->hasPages())<div class="mt-5">{{ $subscribers->links() }}</div>@endif
@endsection