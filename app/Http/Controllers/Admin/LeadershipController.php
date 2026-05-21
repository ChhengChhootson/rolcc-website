<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leadership;
use Illuminate\Http\Request;

class LeadershipController extends Controller
{
    public function index()
    {
        $leaders = Leadership::ordered()->get();
        return view('admin.leadership.index', compact('leaders'));
    }

    public function create()
    {
        return view('admin.leadership.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'facebook' => 'nullable|url',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('leadership', 'public');
        }

        Leadership::create($validated);

        return redirect()->route('admin.leadership.index')->with('success', 'Leader added successfully.');
    }

    public function edit(Leadership $leadership)
    {
        return view('admin.leadership.edit', compact('leadership'));
    }

    public function update(Request $request, Leadership $leadership)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'facebook' => 'nullable|url',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('leadership', 'public');
        }

        $leadership->update($validated);

        return redirect()->route('admin.leadership.index')->with('success', 'Leader updated successfully.');
    }

    public function destroy(Leadership $leadership)
    {
        $leadership->delete();
        return redirect()->route('admin.leadership.index')->with('success', 'Leader removed successfully.');
    }
}
