<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
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
                return back()->with('success', 'Welcome back! You have been re-subscribed.');
            }
            return back()->with('info', 'You are already subscribed to our newsletter!');
        }

        Newsletter::create([
            'email' => $validated['email'],
            'name' => $validated['name'] ?? null,
            'source' => 'website',
        ]);

        return back()->with('success', 'Thank you for subscribing! God bless you.');
    }

    public function unsubscribe(string $token)
    {
        $subscriber = Newsletter::where('token', $token)->firstOrFail();
        $subscriber->unsubscribe('User requested');

        return view('public.newsletter.unsubscribed');
    }
}
