<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\AlbumPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::withCount('photos')->latest()->paginate(15);
        return view('admin.albums.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.albums.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'cover_image' => 'nullable|image|max:4096',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')
                ->store('albums/covers', 'public');
        }

        $validated['slug'] = Str::slug($validated['title']);
        Album::create($validated);

        return redirect()->route('admin.albums.index')->with('success', 'Album created successfully.');
    }

    public function show(Album $album)
    {
        $photos = $album->photos()->ordered()->get();
        return view('admin.albums.show', compact('album', 'photos'));
    }

    public function edit(Album $album)
    {
        return view('admin.albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'cover_image' => 'nullable|image|max:4096',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')
                ->store('albums/covers', 'public');
        }

        $album->update($validated);
        return redirect()->route('admin.albums.index')->with('success', 'Album updated successfully.');
    }

    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->route('admin.albums.index')->with('success', 'Album deleted successfully.');
    }

    public function uploadPhotos(Request $request, Album $album)
    {
        $request->validate([
            'photos' => 'required|array',
            'photos.*' => 'image|max:4096',
        ]);

        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('albums/' . $album->id, 'public');
            AlbumPhoto::create([
                'album_id' => $album->id,
                'path' => $path,
                'caption' => null,
            ]);
        }

        return back()->with('success', count($request->file('photos')) . ' photos uploaded.');
    }
}
