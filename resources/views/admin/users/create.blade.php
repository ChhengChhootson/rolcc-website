@extends('layouts.admin')
@section('title', 'Add User')
@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-3 mb-8">
        <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a>
        <h1 class="text-2xl font-bold text-gray-900">Add New User</h1>
    </div>
    <form method="POST" action="{{ route('admin.users.store') }}" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 space-y-5">
        @csrf
        <div class="grid grid-cols-2 gap-5">
            <div class="col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1.5">Full Name *</label><input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"></div>
            <div class="col-span-2"><label class="block text-sm font-medium text-gray-700 mb-1.5">Email *</label><input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Password *</label><input type="password" name="password" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Confirm Password *</label><input type="password" name="password_confirmation" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Role *</label><select name="role" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">@foreach($roles as $role)<option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $role->name)) }}</option>@endforeach</select></div>
            <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label><select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
        </div>
        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('admin.users.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-colors">Cancel</a>
            <button type="submit" class="px-8 py-3 text-white font-bold rounded-xl hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Create User</button>
        </div>
    </form>
</div>
@endsection