<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrayerRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PrayerRequestController extends Controller
{
    public function index(Request $request)
    {
        $prayers = PrayerRequest::with(['user', 'assignee'])
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->category, fn($q) => $q->where('category', $request->category))
            ->when($request->urgent, fn($q) => $q->where('is_urgent', true))
            ->orderByDesc('is_urgent')
            ->orderByDesc('created_at')
            ->paginate(20);

        $stats = [
            'pending' => PrayerRequest::where('status', 'pending')->count(),
            'praying' => PrayerRequest::where('status', 'praying')->count(),
            'answered' => PrayerRequest::where('status', 'answered')->count(),
            'urgent' => PrayerRequest::urgent()->where('status', 'pending')->count(),
        ];

        return view('admin.prayers.index', compact('prayers', 'stats'));
    }

    public function show(PrayerRequest $prayerRequest)
    {
        $prayerRequest->load(['user', 'assignee']);
        $team = User::whereHas('roles', fn($q) => $q->whereIn('name', ['super_admin', 'editor']))->get();
        return view('admin.prayers.show', compact('prayerRequest', 'team'));
    }

    public function update(Request $request, PrayerRequest $prayerRequest)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,praying,answered,archived',
            'admin_notes' => 'nullable|string|max:2000',
            'response' => 'nullable|string|max:2000',
            'assigned_to' => 'nullable|exists:users,id',
            'is_public' => 'boolean',
        ]);

        if ($data['status'] === 'answered' && !$prayerRequest->answered_at) {
            $data['answered_at'] = now();
        }

        $prayerRequest->update($data);

        return back()->with('success', 'Prayer request updated.');
    }

    public function destroy(PrayerRequest $prayerRequest)
    {
        $prayerRequest->delete();
        return redirect()->route('admin.prayers.index')->with('success', 'Prayer request deleted.');
    }
}
