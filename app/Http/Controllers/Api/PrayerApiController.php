<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PrayerRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PrayerApiController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'request' => 'required|string|max:2000',
            'is_anonymous' => 'boolean',
            'is_private' => 'boolean',
            'category' => 'nullable|string|max:100',
        ]);

        PrayerRequest::create([
            'name' => $validated['is_anonymous'] ?? false ? null : ($validated['name'] ?? null),
            'email' => $validated['email'] ?? null,
            'request' => $validated['request'],
            'is_anonymous' => $validated['is_anonymous'] ?? false,
            'is_private' => $validated['is_private'] ?? false,
            'category' => $validated['category'] ?? 'General',
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Your prayer request has been submitted.'], 201);
    }
}
