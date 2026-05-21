<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Ministry;
use Illuminate\Support\Facades\Cache;

class MinistryController extends Controller
{
    public function index()
    {
        $ministries = Cache::remember('public_ministries', 3600, function () {
            return Ministry::active()
                ->with(['leaders' => fn($q) => $q->where('is_primary', true)])
                ->orderBy('order')
                ->get();
        });

        return view('public.ministries.index', compact('ministries'));
    }

    public function show(string $slug)
    {
        $ministry = Ministry::active()
            ->with(['leaders'])
            ->where('slug', $slug)
            ->firstOrFail();

        $otherMinistries = Ministry::active()
            ->where('id', '!=', $ministry->id)
            ->orderBy('order')
            ->limit(4)
            ->get();

        return view('public.ministries.show', compact('ministry', 'otherMinistries'));
    }
}
