@extends('layouts.admin')
@section('title', 'Edit Ministry')
@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.ministries.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Ministry</h1>
    </div>
    <form method="POST" action="{{ route('admin.ministries.update', $ministry) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Ministry Name *</label>
                <input type="text" name="name" value="{{ old('name', $ministry->name) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Short Description</label>
                <input type="text" name="short_description" value="{{ old('short_description', $ministry->short_description) }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Full Description</label>
                <textarea name="description" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition resize-none">{{ old('description', $ministry->description) }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Meeting Schedule</label>
                    <input type="text" name="meeting_schedule" value="{{ old('meeting_schedule', $ministry->meeting_schedule) }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Contact Email</label>
                    <input type="email" name="contact_email" value="{{ old('contact_email', $ministry->contact_email) }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Display Order</label>
                    <input type="number" name="order" value="{{ old('order', $ministry->order) }}" min="0" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    @if($ministry->image)
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                    <img src="{{ asset('storage/' . $ministry->image) }}" class="w-24 h-16 object-cover rounded-lg mb-2">
                    @endif
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ $ministry->image ? 'Replace' : 'Add' }} Image</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
            </div>
            <div class="flex gap-5 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ $ministry->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600">
                    <span class="text-sm text-gray-700">Active</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ $ministry->is_featured ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600">
                    <span class="text-sm text-gray-700">Featured on Homepage</span>
                </label>
            </div>
        </div>
        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.ministries.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors">Cancel</a>
            <button type="submit" class="px-8 py-3 text-white font-bold rounded-xl hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Update Ministry</button>
        </div>
    </form>
</div>
@endsection
