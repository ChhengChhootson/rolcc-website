<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function __construct(private MediaService $mediaService) {}

    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('order')->get();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $inputs = $request->except(['_token', '_method']);

        foreach ($inputs as $key => $value) {
            if ($request->hasFile($key)) {
                $paths = $this->mediaService->uploadImage($request->file($key), 'settings', false);
                Setting::set($key, $paths['original']);
            } else {
                Setting::set($key, $value);
            }
        }

        Cache::flush();

        return back()->with('success', 'Settings saved successfully.');
    }

    public function branding()
    {
        $settings = Setting::where('group', 'branding')->get()->mapWithKeys(fn($s) => [$s->key => $s->value]);
        return view('admin.settings.branding', compact('settings'));
    }

    public function social()
    {
        $settings = Setting::where('group', 'social')->get()->mapWithKeys(fn($s) => [$s->key => $s->value]);
        return view('admin.settings.social', compact('settings'));
    }

    public function seo()
    {
        $settings = Setting::where('group', 'seo')->get()->mapWithKeys(fn($s) => [$s->key => $s->value]);
        return view('admin.settings.seo', compact('settings'));
    }

    public function livestream()
    {
        $settings = Setting::where('group', 'livestream')->get()->mapWithKeys(fn($s) => [$s->key => $s->value]);
        return view('admin.settings.livestream', compact('settings'));
    }
}
