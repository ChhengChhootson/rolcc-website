@extends('layouts.admin')
@section('title', 'Photo Albums')
@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Photo Albums</h1>
    <a href="{{ route('admin.albums.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-white font-semibold rounded-xl text-sm hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg> New Album</a>
</div>
@if(session('success'))<div class="mb-5 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>@endif
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
    @forelse($albums as $album)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="h-40 overflow-hidden relative">
            @if($album->cover_image)<img src="{{ asset('storage/' . $album->cover_image) }}" class="w-full h-full object-cover">
            @else<div class="w-full h-full flex items-center justify-center" style="background: linear-gradient(135deg, #0B4F8C, #3C8DDB)"><svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>@endif
            <div class="absolute bottom-2 right-2 bg-black/50 text-white text-xs px-2 py-0.5 rounded-full">{{ $album->photos_count ?? 0 }} photos</div>
        </div>
        <div class="p-4">
            <div class="font-bold text-gray-900 mb-1">{{ $album->title }}</div>
            <div class="text-xs text-gray-400">{{ $album->event_date ? \Carbon\Carbon::parse($album->event_date)->format('M j, Y') : $album->created_at->format('M j, Y') }}</div>
            <div class="flex gap-2 mt-3">
                <a href="{{ route('admin.albums.show', $album) }}" class="flex-1 text-center px-3 py-2 text-xs font-semibold border border-blue-200 text-blue-700 rounded-lg hover:bg-blue-50">Manage Photos</a>
                <a href="{{ route('admin.albums.edit', $album) }}" class="px-3 py-2 text-xs font-semibold border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50">Edit</a>
                <form method="POST" action="{{ route('admin.albums.destroy', $album) }}" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="px-3 py-2 text-xs font-semibold border border-red-200 text-red-600 rounded-lg hover:bg-red-50">Del</button></form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-16 text-gray-400">No albums yet.</div>
    @endforelse
</div>
@endsection