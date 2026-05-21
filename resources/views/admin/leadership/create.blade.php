@extends('layouts.admin')
@section('title', 'Add Leader')
@section('content')
<div class="max-w-2xl mx-auto"><div class="flex items-center gap-3 mb-8"><a href="{{ route('admin.leadership.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a><h1 class="text-2xl font-bold text-gray-900">Add Leader</h1></div>
<form method="POST" action="{{ route('admin.leadership.store') }}" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 space-y-5">
@csrf
<div class="grid grid-cols-2 gap-5">
<div class="col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1.5">Full Name *</label><input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"></div>
<div class="col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1.5">Title/Role *</label><input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. Senior Pastor" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"></div>
<div><label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label><input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"></div>
<div><label class="block text-sm font-medium text-gray-700 mb-1.5">Photo</label><input type="file" name="photo" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-xl"></div>
<div class="col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1.5">Bio</label><textarea name="bio" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-xl resize-none">{{ old('bio') }}</textarea></div>
<div><label class="block text-sm font-medium text-gray-700 mb-1.5">Sort Order</label><input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"></div>
<div class="flex items-end pb-3"><label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="is_active" value="1" checked class="rounded border-gray-300 text-blue-600"><span class="text-sm text-gray-700">Active</span></label></div>
</div>
<div class="flex justify-end gap-3"><a href="{{ route('admin.leadership.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50">Cancel</a><button type="submit" class="px-8 py-3 text-white font-bold rounded-xl hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Save</button></div>
</form></div>
@endsection