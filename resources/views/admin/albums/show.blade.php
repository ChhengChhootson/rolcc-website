@extends('layouts.admin')
@section('title', 'Manage Photos')
@section('content')
<div class="flex items-center gap-3 mb-8"><a href="{{ route('admin.albums.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a><div><h1 class="text-2xl font-bold text-gray-900">{{ $album->title }}</h1><p class="text-gray-500 text-sm">{{ $photos->count() }} photos</p></div></div>
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-6">
    <h3 class="font-semibold text-gray-900 mb-4">Upload Photos</h3>
    <form method="POST" action="{{ route('admin.albums.upload', $album) }}" enctype="multipart/form-data" class="flex gap-4">
        @csrf
        <input type="file" name="photos[]" multiple accept="image/*" class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition text-sm">
        <button type="submit" class="px-6 py-3 text-white font-bold rounded-xl hover:opacity-90 text-sm" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Upload</button>
    </form>
</div>
<div class="grid sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
    @foreach($photos as $photo)
    <div class="group relative aspect-square overflow-hidden rounded-xl bg-gray-100">
        <img src="{{ asset('storage/' . $photo->path) }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
            <form method="POST" action="#" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="text-white text-xs font-semibold">Delete</button></form>
        </div>
    </div>
    @endforeach
</div>
@endsection