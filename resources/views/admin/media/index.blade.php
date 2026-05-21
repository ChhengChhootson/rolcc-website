@extends('layouts.admin')
@section('title','Media Library')
@section('content')
<div class="flex items-center justify-between mb-8"><h1 class="text-2xl font-bold text-gray-900">Media Library</h1>
<form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data" class="flex gap-3">@csrf<input type="file" name="file" class="px-4 py-2.5 border border-gray-300 rounded-xl text-sm"><button type="submit" class="px-5 py-2.5 text-white font-semibold rounded-xl text-sm hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Upload</button></form>
</div>
@if(session('success'))<div class="mb-5 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>@endif
<div class="grid sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
@forelse($media as $file)
<div class="group relative bg-white rounded-xl border border-gray-200 overflow-hidden">
    @if(str_starts_with($file->mime_type??'','image/'))<img src="{{ asset('storage/'.$file->path) }}" class="w-full aspect-square object-cover">
    @else<div class="w-full aspect-square flex items-center justify-center bg-gray-50"><svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></div>@endif
    <div class="p-2"><p class="text-xs text-gray-600 truncate">{{ $file->original_name ?? basename($file->path) }}</p>
    <form method="POST" action="{{ route('admin.media.destroy',$file) }}" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="text-xs text-red-500 hover:text-red-700">Delete</button></form></div>
</div>
@empty<div class="col-span-6 text-center py-16 text-gray-400">No media files yet.</div>@endforelse
</div>
@if($media->hasPages())<div class="mt-5">{{ $media->links() }}</div>@endif
@endsection