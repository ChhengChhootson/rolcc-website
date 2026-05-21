@extends('layouts.admin')

@section('title', 'Sermons')
@section('breadcrumb')
<span class="text-gray-700 font-medium">Sermons</span>
@endsection

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="admin-page-header">
        <div>
            <h1 class="admin-page-title">Sermons</h1>
            <p class="text-gray-500 text-sm mt-1">Manage all sermon videos, audio, and notes</p>
        </div>
        <a href="{{ route('admin.sermons.create') }}" class="admin-btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Sermon
        </a>
    </div>

    {{-- Filters --}}
    <div class="admin-card">
        <div class="admin-card-body">
            <form method="GET" action="{{ route('admin.sermons.index') }}" class="flex flex-wrap gap-3">
                <div class="relative flex-1 min-w-[200px]">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search sermons..."
                           class="admin-input pl-9">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <select name="category" class="admin-select w-40">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <select name="status" class="admin-select w-32">
                    <option value="">All Status</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="scheduled" {{ request('status') === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                </select>
                <button type="submit" class="admin-btn-primary">Filter</button>
                @if(request()->hasAny(['search', 'category', 'status']))
                <a href="{{ route('admin.sermons.index') }}" class="admin-btn-secondary">Clear</a>
                @endif
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="admin-card">
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th class="w-12">
                            <input type="checkbox" class="rounded border-gray-300">
                        </th>
                        <th>Sermon</th>
                        <th>Speaker</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Date</th>
                        <th class="w-32">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sermons as $sermon)
                    <tr>
                        <td><input type="checkbox" class="rounded border-gray-300"></td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="w-16 h-10 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                    <img src="{{ $sermon->thumbnail_url }}" alt="{{ $sermon->title }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900 text-sm line-clamp-1">{{ $sermon->title }}</div>
                                    <div class="text-xs text-gray-400 mt-0.5 flex items-center gap-2">
                                        @if($sermon->video_type)
                                        <span class="capitalize">{{ $sermon->video_type }}</span>
                                        @endif
                                        @if($sermon->scripture_reference)
                                        <span class="text-church-blue">{{ $sermon->scripture_reference }}</span>
                                        @endif
                                        @if($sermon->is_featured)
                                        <span class="bg-amber-100 text-amber-600 px-1.5 py-0.5 rounded text-xs font-medium">⭐ Featured</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-sm text-gray-600">{{ $sermon->speaker ?? '—' }}</span>
                        </td>
                        <td>
                            @if($sermon->category)
                            <span class="text-xs font-medium px-2 py-1 rounded-full" style="background-color: {{ $sermon->category->color }}20; color: {{ $sermon->category->color }}">
                                {{ $sermon->category->name }}
                            </span>
                            @else
                            <span class="text-gray-300">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $sermon->status === 'published' ? 'badge-published' : ($sermon->status === 'draft' ? 'badge-draft' : 'badge-pending') }}">
                                {{ ucfirst($sermon->status) }}
                            </span>
                        </td>
                        <td>
                            <span class="text-sm text-gray-600">{{ number_format($sermon->views) }}</span>
                        </td>
                        <td>
                            <span class="text-xs text-gray-400">
                                {{ $sermon->preached_date?->format('M d, Y') ?? $sermon->created_at->format('M d, Y') }}
                            </span>
                        </td>
                        <td>
                            <div class="flex items-center gap-1">
                                <a href="{{ route('sermons.show', $sermon->slug) }}" target="_blank"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-church-blue hover:bg-blue-50 transition-colors" title="View">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                                <a href="{{ route('admin.sermons.edit', $sermon) }}"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-church-blue hover:bg-blue-50 transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.sermons.toggle-featured', $sermon) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg transition-colors {{ $sermon->is_featured ? 'text-amber-500 bg-amber-50' : 'text-gray-400 hover:text-amber-500 hover:bg-amber-50' }}" title="{{ $sermon->is_featured ? 'Unfeature' : 'Feature' }}">
                                        <svg class="w-4 h-4" fill="{{ $sermon->is_featured ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.sermons.destroy', $sermon) }}" onsubmit="return confirm('Delete this sermon?');" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-12 text-gray-400">
                            <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 10l4.553-2.069A1 1 0 0121 8.868v6.264a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            No sermons found.
                            <a href="{{ route('admin.sermons.create') }}" class="text-church-blue hover:underline ml-1">Add your first sermon →</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($sermons->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $sermons->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
