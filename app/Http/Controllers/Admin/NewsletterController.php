<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $subscribers = Newsletter::when($request->search, fn($q) => $q->where('email', 'like', "%{$request->search}%"))
            ->when($request->status === 'active', fn($q) => $q->where('is_subscribed', true))
            ->when($request->status === 'unsubscribed', fn($q) => $q->where('is_subscribed', false))
            ->latest()
            ->paginate(30);

        $totalCount = Newsletter::count();
        $activeCount = Newsletter::where('is_subscribed', true)->count();

        return view('admin.newsletter.index', compact('subscribers', 'totalCount', 'activeCount'));
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return back()->with('success', 'Subscriber removed.');
    }

    public function export()
    {
        $subscribers = Newsletter::where('is_subscribed', true)->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="subscribers-' . now()->format('Y-m-d') . '.csv"',
        ];

        $callback = function () use ($subscribers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Name', 'Email', 'Subscribed At', 'Source']);

            foreach ($subscribers as $sub) {
                fputcsv($file, [
                    $sub->name,
                    $sub->email,
                    $sub->subscribed_at?->format('Y-m-d'),
                    $sub->source,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
