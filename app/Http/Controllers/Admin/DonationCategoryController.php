<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonationCategoryController extends Controller
{
    public function index()
    {
        $categories = DonationCategory::withCount('donations')->ordered()->get();
        return view('admin.donation-categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:donation_categories',
            'description' => 'nullable|string',
            'goal_amount' => 'nullable|numeric|min:0',
            'color' => 'nullable|string|max:7',
            'icon' => 'nullable|string|max:50',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        DonationCategory::create($validated);

        return back()->with('success', 'Category created successfully.');
    }

    public function update(Request $request, DonationCategory $donationCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:donation_categories,name,' . $donationCategory->id,
            'description' => 'nullable|string',
            'goal_amount' => 'nullable|numeric|min:0',
            'color' => 'nullable|string|max:7',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
        ]);

        $donationCategory->update($validated);
        return back()->with('success', 'Category updated successfully.');
    }

    public function destroy(DonationCategory $donationCategory)
    {
        $donationCategory->delete();
        return back()->with('success', 'Category deleted successfully.');
    }
}
