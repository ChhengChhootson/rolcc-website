<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationCategory;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        $donations = Donation::with(['category', 'user'])
            ->when($request->search, fn($q) => $q->where('reference_number', 'like', "%{$request->search}%")
                ->orWhere('donor_name', 'like', "%{$request->search}%"))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->category, fn($q) => $q->where('donation_category_id', $request->category))
            ->latest()
            ->paginate(20);

        $categories = DonationCategory::active()->get();
        $totalAmount = Donation::completed()->sum('amount');
        $monthlyAmount = Donation::completed()
            ->whereMonth('created_at', now()->month)
            ->sum('amount');

        return view('admin.donations.index', compact('donations', 'categories', 'totalAmount', 'monthlyAmount'));
    }

    public function show(Donation $donation)
    {
        return view('admin.donations.show', compact('donation'));
    }

    public function update(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,failed,refunded',
            'notes' => 'nullable|string',
        ]);

        $donation->update($validated);

        return back()->with('success', 'Donation status updated.');
    }

    public function export(Request $request)
    {
        $donations = Donation::with(['category', 'user'])
            ->when($request->from, fn($q) => $q->whereDate('created_at', '>=', $request->from))
            ->when($request->to, fn($q) => $q->whereDate('created_at', '<=', $request->to))
            ->completed()
            ->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="donations-' . now()->format('Y-m-d') . '.csv"',
        ];

        $callback = function () use ($donations) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Reference', 'Donor', 'Email', 'Amount', 'Category', 'Method', 'Date']);

            foreach ($donations as $d) {
                fputcsv($file, [
                    $d->reference_number,
                    $d->donor_name,
                    $d->donor_email,
                    $d->amount,
                    $d->category?->name,
                    $d->payment_method,
                    $d->created_at->format('Y-m-d'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
