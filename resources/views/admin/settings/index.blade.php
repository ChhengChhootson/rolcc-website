@extends('layouts.admin')
@section('title', 'Settings')
@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">General Settings</h1>

    <div class="flex gap-4 mb-8 overflow-x-auto pb-2">
        @foreach([
            ['route' => 'admin.settings.index', 'label' => 'General'],
            ['route' => 'admin.settings.branding', 'label' => 'Branding'],
            ['route' => 'admin.settings.social', 'label' => 'Social Media'],
            ['route' => 'admin.settings.seo', 'label' => 'SEO'],
            ['route' => 'admin.settings.livestream', 'label' => 'Livestream'],
        ] as $tab)
        <a href="{{ route($tab['route']) }}" class="px-4 py-2.5 rounded-xl text-sm font-semibold whitespace-nowrap transition-colors {{ Route::currentRouteName() == $tab['route'] ? 'bg-blue-700 text-white' : 'border border-gray-300 text-gray-600 hover:bg-gray-50' }}">{{ $tab['label'] }}</a>
        @endforeach
    </div>

    @if(session('success'))<div class="mb-5 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>@endif

    <form method="POST" action="{{ route('admin.settings.update') }}" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 space-y-5">
        @csrf @method('PUT')
        @foreach($settings ?? [] as $setting)
        @if($setting->group === 'general')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</label>
            @if($setting->type === 'text' || $setting->type === 'email' || $setting->type === 'url')
            <input type="{{ $setting->type }}" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
            @elseif($setting->type === 'textarea')
            <textarea name="settings[{{ $setting->key }}]" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition resize-none">{{ $setting->value }}</textarea>
            @elseif($setting->type === 'boolean')
            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="settings[{{ $setting->key }}]" value="1" {{ $setting->value ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600"><span class="text-sm text-gray-700">Enabled</span></label>
            @endif
        </div>
        @endif
        @endforeach
        <div class="pt-4">
            <button type="submit" class="px-8 py-3 text-white font-bold rounded-xl hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Save Settings</button>
        </div>
    </form>
</div>
@endsection
