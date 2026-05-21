<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $events = Event::published()
            ->when($request->upcoming, fn($q) => $q->upcoming())
            ->when($request->month, fn($q) => $q->whereMonth('start_date', $request->month))
            ->when($request->year, fn($q) => $q->whereYear('start_date', $request->year))
            ->orderBy('start_date')
            ->paginate(12);

        return response()->json($events);
    }

    public function show(string $slug): JsonResponse
    {
        $event = Event::published()->where('slug', $slug)->firstOrFail();
        return response()->json($event);
    }

    public function upcoming(): JsonResponse
    {
        $events = Event::published()->upcoming()->limit(5)->orderBy('start_date')->get();
        return response()->json($events);
    }
}
