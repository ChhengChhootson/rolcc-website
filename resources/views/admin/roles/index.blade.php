@extends('layouts.admin')
@section('title', 'Roles & Permissions')
@section('content')
<div class="flex items-center justify-between mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Roles & Permissions</h1>
    <a href="{{ route('admin.roles.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-white font-semibold rounded-xl text-sm hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg> Add Role</a>
</div>
@if(session('success'))<div class="mb-5 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>@endif
<div class="grid gap-4">
    @foreach($roles as $role)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <div><span class="text-lg font-bold text-gray-900">{{ ucwords(str_replace('_', ' ', $role->name)) }}</span><span class="ml-2 text-sm text-gray-400">{{ $role->users_count ?? $role->users()->count() }} users</span></div>
            <div class="flex gap-2">
                <a href="{{ route('admin.roles.edit', $role) }}" class="px-3 py-1.5 text-xs font-semibold border border-blue-200 text-blue-700 rounded-lg hover:bg-blue-50">Edit</a>
                @if(!in_array($role->name, ['super_admin','admin']))
                <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="px-3 py-1.5 text-xs font-semibold border border-red-200 text-red-600 rounded-lg hover:bg-red-50">Delete</button></form>
                @endif
            </div>
        </div>
        <div class="flex flex-wrap gap-2">
            @foreach($role->permissions->take(10) as $perm)
            <span class="px-2 py-0.5 text-xs bg-gray-100 text-gray-600 rounded-md">{{ $perm->name }}</span>
            @endforeach
            @if($role->permissions->count() > 10)<span class="px-2 py-0.5 text-xs bg-gray-100 text-gray-500 rounded-md">+{{ $role->permissions->count() - 10 }} more</span>@endif
        </div>
    </div>
    @endforeach
</div>
@endsection