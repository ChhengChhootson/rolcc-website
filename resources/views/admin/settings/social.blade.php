@extends('layouts.admin')
@section('title', 'Social Settings')
@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">Social Settings</h1>
    <div class="flex gap-4 mb-8 overflow-x-auto pb-2">
        @foreach([['admin.settings.index','General'],['admin.settings.branding','Branding'],['admin.settings.social','Social'],['admin.settings.seo','SEO'],['admin.settings.livestream','Livestream']] as [$r,$l])
        <a href="{{ route($r) }}" class="px-4 py-2.5 rounded-xl text-sm font-semibold whitespace-nowrap transition-colors {{ Route::currentRouteName() == $r ? 'bg-blue-700 text-white' : 'border border-gray-300 text-gray-600 hover:bg-gray-50' }}">{{ $l }}</a>
        @endforeach
    </div>
    @if(session('success'))<div class="mb-5 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>@endif
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 space-y-5">
        @csrf @method('PUT')
        @foreach($settings ?? [] as $setting)
        @if($setting->group === 'social')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</label>
            @if($setting->type === 'image')
                @if($setting->value)<img src="{{ $setting->value }}" class="w-32 h-20 object-contain rounded-lg mb-2 border">@endif
                <input type="file" name="settings_files[{{ $setting->key }}]" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-xl">
            @elseif($setting->type === 'textarea')
                <textarea name="settings[{{ $setting->key }}]" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-xl resize-none">{{ $setting->value }}</textarea>
            @elseif($setting->type === 'boolean')
                <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="settings[{{ $setting->key }}]" value="1" {{ $setting->value ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600"><span class="text-sm text-gray-700">Enabled</span></label>
            @else
                <input type="text" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl">
            @endif
        </div>
        @endif
        @endforeach
        <div class="pt-4"><button type="submit" class="px-8 py-3 text-white font-bold rounded-xl hover:opacity-90" style="background: linear-gradient(135deg, #0B4F8C, #145DA0)">Save Settings</button></div>
    </form>
</div>
@endsection