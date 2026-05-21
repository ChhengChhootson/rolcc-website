<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function __construct(private MediaService $mediaService) {}

    public function index(Request $request)
    {
        $media = Media::when($request->type, fn($q) => $q->where('type', $request->type))
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->latest()
            ->paginate(30);

        return view('admin.media.index', compact('media'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
            'folder' => 'nullable|string|max:100',
        ]);

        $media = $this->mediaService->upload($request->file('file'), $request->folder ?? 'general');

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'media' => $media]);
        }

        return back()->with('success', 'File uploaded successfully.');
    }

    public function destroy(Media $media)
    {
        $this->mediaService->delete($media->path);
        $media->delete();

        return back()->with('success', 'File deleted successfully.');
    }
}
