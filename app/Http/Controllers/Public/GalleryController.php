<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'all');

        $albums = Album::published()
            ->with(['media' => fn($q) => $q->limit(4)])
            ->when($type !== 'all', fn($q) => $q->where('album_type', $type))
            ->orderByDesc('event_date')
            ->paginate(12);

        return view('public.gallery.index', compact('albums', 'type'));
    }

    public function show(string $slug)
    {
        $album = Album::published()
            ->with('media')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('public.gallery.show', compact('album'));
    }
}
