@extends('layouts.admin')
@section('title', 'Announcements')
@section('content')
<div class="flex items-center justify-between mb-8"><h1 class="text-2xl font-bold text-gray-900">Announcements</h1><a href="{{ route('admin.announcements.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-white font-semibold rounded-xl text-sm hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">New</a></div>
@if(session('success'))<div class="mb-5 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>@endif
<div class="space-y-3">
@forelse($announcements as $a)
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 flex items-start justify-between gap-4">
    <div class="flex-1"><div class="flex items-center gap-2 mb-1"><span class="w-2 h-2 rounded-full {{ $a->type === 'info' ? 'bg-blue-500' : ($a->type === 'warning' ? 'bg-yellow-500' : ($a->type === 'success' ? 'bg-green-500' : 'bg-red-500')) }}"></span><div class="font-semibold text-gray-900">{{ $a->title }}</div>@if(!$a->is_active)<span class="px-2 py-0.5 text-xs bg-gray-100 text-gray-500 rounded-full">Inactive</span>@endif</div><p class="text-gray-500 text-sm">{{ Str::limit($a->content, 100) }}</p></div>
    <div class="flex gap-2 flex-shrink-0"><a href="{{ route('admin.announcements.edit',$a) }}" class="px-3 py-1.5 text-xs font-semibold border border-blue-200 text-blue-700 rounded-lg hover:bg-blue-50">Edit</a><form method="POST" action="{{ route('admin.announcements.destroy',$a) }}" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="px-3 py-1.5 text-xs font-semibold border border-red-200 text-red-600 rounded-lg hover:bg-red-50">Delete</button></form></div>
</div>
@empty<div class="text-center py-16 text-gray-400">No announcements.</div>@endforelse
</div>
@endsection