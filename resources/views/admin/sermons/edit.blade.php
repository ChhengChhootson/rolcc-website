@extends('layouts.admin')
@section('title', 'Edit Sermon')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.sermons.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Sermon</h1>
    </div>

    <form method="POST" action="{{ route('admin.sermons.update', $sermon) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-5">Sermon Details</h2>
            <div class="grid md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Sermon Title *</label>
                    <input type="text" name="title" value="{{ old('title', $sermon->title) }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Speaker</label>
                    <input type="text" name="speaker" value="{{ old('speaker', $sermon->speaker) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Category</label>
                    <select name="sermon_category_id" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                        <option value="">— Select Category —</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('sermon_category_id', $sermon->sermon_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Scripture Reference</label>
                    <input type="text" name="scripture_reference" value="{{ old('scripture_reference', $sermon->scripture_reference) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Published Date</label>
                    <input type="date" name="published_at" value="{{ old('published_at', $sermon->published_at?->format('Y-m-d')) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Video URL</label>
                    <input type="url" name="video_url" value="{{ old('video_url', $sermon->video_url) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition resize-none">{{ old('description', $sermon->description) }}</textarea>
                </div>
                @if($sermon->thumbnail)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Thumbnail</label>
                    <img src="{{ asset('storage/' . $sermon->thumbnail) }}" class="w-32 h-20 object-cover rounded-lg mb-2">
                </div>
                @endif
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ $sermon->thumbnail ? 'Replace' : 'Add' }} Thumbnail</label>
                    <input type="file" name="thumbnail" accept="image/*"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                    <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                        <option value="draft" {{ old('status', $sermon->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $sermon->status) == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
                <div class="flex items-center gap-2 pt-8">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ $sermon->is_featured ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600">
                    <label for="is_featured" class="text-sm text-gray-700 cursor-pointer">Featured Sermon</label>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.sermons.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors">Cancel</a>
            <button type="submit" class="px-8 py-3 text-white font-bold rounded-xl transition-all hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Update Sermon</button>
        </div>
    </form>
</div>
@endsection
