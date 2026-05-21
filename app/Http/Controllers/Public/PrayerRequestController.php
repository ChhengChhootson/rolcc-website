<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\PrayerRequest;
use App\Http\Requests\Public\PrayerRequestFormRequest;
use Illuminate\Http\Request;

class PrayerRequestController extends Controller
{
    public function index()
    {
        $publicRequests = PrayerRequest::public()
            ->where('status', '!=', 'archived')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('public.prayer.index', compact('publicRequests'));
    }

    public function store(PrayerRequestFormRequest $request)
    {
        $data = $request->validated();

        if ($data['is_anonymous']) {
            $data['name'] = null;
            $data['email'] = null;
        }

        PrayerRequest::create(array_merge($data, [
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]));

        return back()->with('success', 'Your prayer request has been submitted. Our team will be praying for you!');
    }

    public function incrementPrayer(int $id)
    {
        $request = PrayerRequest::where('is_public', true)->findOrFail($id);
        $request->increment('prayer_count');

        return response()->json(['count' => $request->prayer_count]);
    }
}
