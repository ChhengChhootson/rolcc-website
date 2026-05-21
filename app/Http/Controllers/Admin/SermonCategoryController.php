<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SermonCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SermonCategoryController extends Controller
{
    public function index()
    {
        $categories = SermonCategory::withCount('sermons')->ordered()->get();
        return view('admin.sermon-categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:sermon_categories',
            'description' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        SermonCategory::create($validated);

        return back()->with('success', 'Category created.');
    }

    public function update(Request $request, SermonCategory $sermonCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:sermon_categories,name,' . $sermonCategory->id,
            'description' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
            'is_active' => 'boolean',
        ]);

        $sermonCategory->update($validated);
        return back()->with('success', 'Category updated.');
    }

    public function destroy(SermonCategory $sermonCategory)
    {
        $sermonCategory->delete();
        return back()->with('success', 'Category deleted.');
    }
}
