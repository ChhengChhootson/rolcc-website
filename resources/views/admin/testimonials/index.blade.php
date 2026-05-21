@extends('layouts.admin')
@section('title', 'Testimonials')
@section('content')
<div class="flex items-center justify-between mb-8"><h1 class="text-2xl font-bold text-gray-900">Testimonials</h1></div>
@if(session('success'))<div class="mb-5 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>@endif
<div class="space-y-4">
@forelse($testimonials as $t)
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5">
    <div class="flex items-start justify-between gap-4">
        <div class="flex-1">
            <div class="flex items-center gap-3 mb-2"><div class="font-bold text-gray-900">{{ $t->name }}</div>@if($t->is_featured)<span class="px-2 py-0.5 text-xs bg-yellow-100 text-yellow-700 rounded-full">Featured</span>@endif<span class="px-2 py-0.5 text-xs rounded-full font-semibold {{ $t->status === 'approved' ? 'bg-green-100 text-green-700' : ($t->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-600') }}">{{ ucfirst($t->status) }}</span></div>
            <p class="text-gray-600 text-sm">{{ Str::limit($t->content, 200) }}</p>
        </div>
        <div class="flex gap-2 flex-shrink-0">
            @if($t->status !== 'approved')<form method="POST" action="{{ route('admin.testimonials.approve',$t) }}">@csrf @method('PATCH')<button class="px-3 py-1.5 text-xs font-semibold bg-green-600 text-white rounded-lg hover:bg-green-700">Approve</button></form>@endif
            <form method="POST" action="{{ route('admin.testimonials.toggle-featured',$t) }}">@csrf @method('PATCH')<button class="px-3 py-1.5 text-xs font-semibold border border-yellow-300 text-yellow-700 rounded-lg hover:bg-yellow-50">{{ $t->is_featured ? 'Unfeature' : 'Feature' }}</button></form>
            <form method="POST" action="{{ route('admin.testimonials.destroy',$t) }}" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="px-3 py-1.5 text-xs font-semibold border border-red-200 text-red-600 rounded-lg hover:bg-red-50">Delete</button></form>
        </div>
    </div>
</div>
@empty<div class="text-center py-16 text-gray-400">No testimonials.</div>@endforelse
</div>
@if($testimonials->hasPages())<div class="mt-6">{{ $testimonials->links() }}</div>@endif
@endsection