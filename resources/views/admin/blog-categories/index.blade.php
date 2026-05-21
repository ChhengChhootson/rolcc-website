@extends('layouts.admin')
@section('title','Blog Categories')
@section('content')
<div class="mb-8"><h1 class="text-2xl font-bold text-gray-900">Blog Categories</h1></div>
@if(session('success'))<div class="mb-5 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>@endif
<div class="grid lg:grid-cols-2 gap-8">
<div><h2 class="text-lg font-semibold text-gray-900 mb-4">Add Category</h2>
<form method="POST" action="{{ route('admin.blog-categories.store') }}" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 space-y-4">
@csrf
<div><label class="block text-sm font-medium text-gray-700 mb-1.5">Name *</label><input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"></div>
<button type="submit" class="px-6 py-3 text-white font-bold rounded-xl hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Add</button>
</form></div>
<div><h2 class="text-lg font-semibold text-gray-900 mb-4">Existing</h2>
<div class="space-y-2">
@foreach($categories as $cat)
<div class="bg-white rounded-xl border border-gray-200 p-4 flex items-center justify-between">
    <div><div class="font-medium text-gray-900">{{ $cat->name }}</div><div class="text-xs text-gray-400">{{ $cat->blogs_count }} posts</div></div>
    <form method="POST" action="{{ route('admin.blog-categories.destroy',$cat) }}" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="text-red-500"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button></form>
</div>
@endforeach
</div></div>
</div>
@endsection