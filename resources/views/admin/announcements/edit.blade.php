@extends('layouts.admin')
@section('title','Edit Announcement')
@section('content')
<div class="max-w-2xl mx-auto"><div class="flex items-center gap-3 mb-8"><a href="{{ route('admin.announcements.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a><h1 class="text-2xl font-bold text-gray-900">Edit Announcement</h1></div>
<form method="POST" action="{{ route('admin.announcements.update',$announcement) }}" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 space-y-5">
@csrf @method('PUT')
<div><label class="block text-sm font-medium text-gray-700 mb-1.5">Title *</label><input type="text" name="title" value="{{ old('title',$announcement->title) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"></div>
<div><label class="block text-sm font-medium text-gray-700 mb-1.5">Content *</label><textarea name="content" rows="3" required class="w-full px-4 py-3 border border-gray-300 rounded-xl resize-none">{{ old('content',$announcement->content) }}</textarea></div>
<div class="grid grid-cols-2 gap-5">
<div><label class="block text-sm font-medium text-gray-700 mb-1.5">Type</label><select name="type" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">@foreach(['info','success','warning','danger'] as $t)<option value="{{ $t }}" {{ old('type',$announcement->type)==$t?'selected':'' }}>{{ ucfirst($t) }}</option>@endforeach</select></div>
<div><label class="block text-sm font-medium text-gray-700 mb-1.5">Expires</label><input type="date" name="ends_at" value="{{ old('ends_at',$announcement->ends_at?->format('Y-m-d')) }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"></div>
</div>
<div class="flex gap-4"><label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="is_active" value="1" {{ $announcement->is_active?'checked':'' }} class="rounded border-gray-300 text-blue-600"><span class="text-sm text-gray-700">Active</span></label><label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="show_on_homepage" value="1" {{ $announcement->show_on_homepage?'checked':'' }} class="rounded border-gray-300 text-blue-600"><span class="text-sm text-gray-700">Show on Homepage</span></label></div>
<div class="flex justify-end gap-3"><a href="{{ route('admin.announcements.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50">Cancel</a><button type="submit" class="px-8 py-3 text-white font-bold rounded-xl hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Update</button></div>
</form></div>
@endsection