@extends('layouts.admin')
@section('title', 'New Campaign')
@section('content')
<div class="max-w-3xl mx-auto"><div class="flex items-center gap-3 mb-8"><a href="{{ route('admin.newsletter-campaigns.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a><h1 class="text-2xl font-bold text-gray-900">New Campaign</h1></div>
<form method="POST" action="{{ route('admin.newsletter-campaigns.store') }}" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 space-y-5">
@csrf
<div><label class="block text-sm font-medium text-gray-700 mb-1.5">Subject *</label><input type="text" name="subject" value="{{ old('subject') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"></div>
<div><label class="block text-sm font-medium text-gray-700 mb-1.5">Content *</label><textarea name="content" rows="10" required class="w-full px-4 py-3 border border-gray-300 rounded-xl resize-none">{{ old('content') }}</textarea></div>
<div class="grid grid-cols-2 gap-5">
    <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Schedule For (optional)</label><input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at') }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition"></div>
    <div class="flex items-end pb-3"><label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="send_now" value="1" class="rounded border-gray-300 text-blue-600"><span class="text-sm text-gray-700 font-medium">Send Immediately</span></label></div>
</div>
<div class="flex justify-end gap-3"><a href="{{ route('admin.newsletter-campaigns.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50">Cancel</a><button type="submit" class="px-8 py-3 text-white font-bold rounded-xl hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Create Campaign</button></div>
</form></div>
@endsection