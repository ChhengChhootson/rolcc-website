@extends('layouts.admin')
@section('title', 'Edit Event')
@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.events.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Event</h1>
    </div>
    <form method="POST" action="{{ route('admin.events.update', $event) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <div class="grid md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Event Title *</label>
                    <input type="text" name="title" value="{{ old('title', $event->title) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Start Date & Time *</label>
                    <input type="datetime-local" name="start_date" value="{{ old('start_date', $event->start_date?->format('Y-m-d\TH:i')) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">End Date & Time</label>
                    <input type="datetime-local" name="end_date" value="{{ old('end_date', $event->end_date?->format('Y-m-d\TH:i')) }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Location</label>
                    <input type="text" name="location" value="{{ old('location', $event->location) }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                    <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                        @foreach(['draft', 'published', 'cancelled'] as $s)
                        <option value="{{ $s }}" {{ old('status', $event->status) == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
                    <textarea name="description" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition resize-none">{{ old('description', $event->description) }}</textarea>
                </div>
                @if($event->thumbnail)
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Current Thumbnail</label><img src="{{ asset('storage/' . $event->thumbnail) }}" class="w-32 h-20 object-cover rounded-lg mb-2"></div>
                @endif
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ $event->thumbnail ? 'Replace' : 'Add' }} Thumbnail</label>
                    <input type="file" name="thumbnail" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div class="flex flex-wrap gap-5 pt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ $event->is_featured ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600">
                        <span class="text-sm text-gray-700">Featured</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="requires_registration" value="1" {{ $event->requires_registration ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600">
                        <span class="text-sm text-gray-700">Requires Registration</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_free" value="1" {{ $event->is_free ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600">
                        <span class="text-sm text-gray-700">Free Event</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.events.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors">Cancel</a>
            <button type="submit" class="px-8 py-3 text-white font-bold rounded-xl hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Update Event</button>
        </div>
    </form>
</div>
@endsection
