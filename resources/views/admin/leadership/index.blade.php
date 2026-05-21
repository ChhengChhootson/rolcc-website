@extends('layouts.admin')
@section('title', 'Leadership Team')
@section('content')
<div class="flex items-center justify-between mb-8"><h1 class="text-2xl font-bold text-gray-900">Leadership Team</h1><a href="{{ route('admin.leadership.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-white font-semibold rounded-xl text-sm hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Add Leader</a></div>
@if(session('success'))<div class="mb-5 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>@endif
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
@forelse($leaders as $leader)
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 flex gap-4">
    <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0">@if($leader->photo)<img src="{{ asset('storage/'.$leader->photo) }}" class="w-full h-full object-cover">@else<div class="w-full h-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-xl">{{ substr($leader->name,0,1) }}</div>@endif</div>
    <div class="flex-1 min-w-0"><div class="font-bold text-gray-900">{{ $leader->name }}</div><div class="text-blue-600 text-sm">{{ $leader->title }}</div>
    <div class="flex gap-2 mt-3"><a href="{{ route('admin.leadership.edit',$leader) }}" class="px-3 py-1.5 text-xs font-semibold border border-blue-200 text-blue-700 rounded-lg hover:bg-blue-50">Edit</a><form method="POST" action="{{ route('admin.leadership.destroy',$leader) }}" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="px-3 py-1.5 text-xs font-semibold border border-red-200 text-red-600 rounded-lg hover:bg-red-50">Delete</button></form></div></div>
</div>
@empty<div class="col-span-3 text-center py-16 text-gray-400">No leaders added yet.</div>@endforelse
</div>
@endsection