@extends('layouts.admin')
@section('title', 'Edit Blog Post')
@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.blogs.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Blog Post</h1>
    </div>
    <form method="POST" action="{{ route('admin.blogs.update', $blog) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 space-y-5">
            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Title *</label><input type="text" name="title" value="{{ old('title', $blog->title) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"></div>
            <div class="grid grid-cols-2 gap-5">
                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Category</label><select name="blog_category_id" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"><option value="">— Select —</option>@foreach($categories as $cat)<option value="{{ $cat->id }}" {{ old('blog_category_id', $blog->blog_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>@endforeach</select></div>
                <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label><select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"><option value="draft" {{ old('status',$blog->status)=='draft'?'selected':'' }}>Draft</option><option value="published" {{ old('status',$blog->status)=='published'?'selected':'' }}>Published</option></select></div>
            </div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Excerpt</label><textarea name="excerpt" rows="2" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition resize-none">{{ old('excerpt', $blog->excerpt) }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Content *</label><textarea name="content" rows="10" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition resize-none">{{ old('content', $blog->content) }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Featured Image</label><input type="file" name="featured_image" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-xl"></div>
        </div>
        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.blogs.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50">Cancel</a>
            <button type="submit" class="px-8 py-3 text-white font-bold rounded-xl hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Save Post</button>
        </div>
    </form>
</div>
@endsection