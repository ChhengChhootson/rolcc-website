@extends('layouts.admin')
@section('title', 'Edit Role')
@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.roles.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Role</h1>
    </div>
    <form method="POST" action="{{ route('admin.roles.update', $role) }}" class="space-y-6">
        @csrf @method('PUT')
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 space-y-5">
            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Role Name *</label><input type="text" name="name" value="{{ old('name', $role->name) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"></div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Permissions</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach($permissions as $group => $perms)
                    <div class="col-span-full mt-3 mb-1"><span class="text-xs font-bold uppercase tracking-wider text-gray-500">{{ ucfirst($group) }}</span></div>
                    @foreach($perms as $perm)
                    <label class="flex items-center gap-2 cursor-pointer p-2 rounded-lg hover:bg-gray-50">
                        <input type="checkbox" name="permissions[]" value="{{ $perm->name }}" {{ in_array($perm->name, $rolePermissions) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600">
                        <span class="text-xs text-gray-700">{{ $perm->name }}</span>
                    </label>
                    @endforeach
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.roles.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50">Cancel</a>
            <button type="submit" class="px-8 py-3 text-white font-bold rounded-xl hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Save Role</button>
        </div>
    </form>
</div>
@endsection