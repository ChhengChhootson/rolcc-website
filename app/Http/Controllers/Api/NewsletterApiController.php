<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsletterApiController extends Controller
{
    public function subscribe(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'name' => 'nullable|string|max:100',
        ]);

        $existing = Newsletter::where('email', $validated['email'])->first();

        if ($existing) {
            if (!$existing->is_subscribed) {
                $existing->update([
                    'is_subscribed' => true,
                    'subscribed_at' => now(),
                    'unsubscribed_at' => null,
                ]);
                return response()->json(['message' => 'Welcome back! You have been re-subscribed.']);
            }
            return response()->json(['message' => 'You are already subscribed.'], 422);
        }

        Newsletter::create([
            'email' => $validated['email'],
            'name' => $validated['name'] ?? null,
            'source' => 'api',
        ]);

        return response()->json(['message' => 'Thank you for subscribing!'], 201);
    }
}
