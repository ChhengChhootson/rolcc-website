<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendNewsletterCampaign;
use App\Models\NewsletterCampaign;
use Illuminate\Http\Request;

class NewsletterCampaignController extends Controller
{
    public function index()
    {
        $campaigns = NewsletterCampaign::latest()->paginate(15);
        return view('admin.newsletter-campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.newsletter-campaigns.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'scheduled_at' => 'nullable|date|after:now',
            'send_now' => 'boolean',
        ]);

        $campaign = NewsletterCampaign::create([
            'subject' => $validated['subject'],
            'content' => $validated['content'],
            'status' => $request->boolean('send_now') ? 'sending' : 'scheduled',
            'scheduled_at' => $validated['scheduled_at'] ?? null,
            'created_by' => auth()->id(),
        ]);

        if ($request->boolean('send_now')) {
            dispatch(new SendNewsletterCampaign($campaign));
        }

        return redirect()->route('admin.newsletter-campaigns.index')->with('success', 'Campaign created.');
    }

    public function show(NewsletterCampaign $newsletterCampaign)
    {
        return view('admin.newsletter-campaigns.show', compact('newsletterCampaign'));
    }

    public function destroy(NewsletterCampaign $newsletterCampaign)
    {
        if ($newsletterCampaign->status === 'sending') {
            return back()->with('error', 'Cannot delete a campaign that is currently sending.');
        }

        $newsletterCampaign->delete();
        return redirect()->route('admin.newsletter-campaigns.index')->with('success', 'Campaign deleted.');
    }
}
