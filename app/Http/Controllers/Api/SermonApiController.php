<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use App\Models\SermonCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SermonApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $sermons = Sermon::published()
            ->with('category')
            ->when($request->category, fn($q) => $q->whereHas('category', fn($q2) => $q2->where('slug', $request->category)))
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->latest('published_at')
            ->paginate(12);

        return response()->json($sermons);
    }

    public function show(string $slug): JsonResponse
    {
        $sermon = Sermon::published()->where('slug', $slug)->with('category')->firstOrFail();
        $sermon->increment('view_count');

        return response()->json($sermon);
    }

    public function featured(): JsonResponse
    {
        $sermons = Sermon::published()->featured()->limit(3)->get();
        return response()->json($sermons);
    }

    public function categories(): JsonResponse
    {
        $categories = SermonCategory::active()->withCount(['sermons' => fn($q) => $q->published()])->get();
        return response()->json($categories);
    }
}
