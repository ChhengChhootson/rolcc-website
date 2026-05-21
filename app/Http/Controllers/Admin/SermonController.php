<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use App\Models\SermonCategory;
use App\Services\SermonService;
use App\Services\MediaService;
use App\Http\Requests\Admin\SermonRequest;
use Illuminate\Http\Request;

class SermonController extends Controller
{
    public function __construct(
        private SermonService $sermonService,
        private MediaService $mediaService,
    ) {}

    public function index(Request $request)
    {
        $sermons = Sermon::with(['category', 'author'])
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->when($request->category, fn($q) => $q->where('category_id', $request->category))
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->orderByDesc('created_at')
            ->paginate(20);

        $categories = SermonCategory::all();

        return view('admin.sermons.index', compact('sermons', 'categories'));
    }

    public function create()
    {
        $categories = SermonCategory::orderBy('name')->get();
        return view('admin.sermons.create', compact('categories'));
    }

    public function store(SermonRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $paths = $this->mediaService->uploadImage($request->file('thumbnail'), 'sermons/thumbnails', true, ['thumb' => [300, 200]]);
            $data['thumbnail'] = $paths['original'];
        }

        if ($request->hasFile('document')) {
            $data['document_url'] = $this->mediaService->uploadDocument($request->file('document'), 'sermons/documents');
        }

        $sermon = $this->sermonService->createSermon($data, auth()->user());

        activity()->performedOn($sermon)->log('Created sermon: ' . $sermon->title);

        return redirect()->route('admin.sermons.index')
            ->with('success', 'Sermon created successfully.');
    }

    public function edit(Sermon $sermon)
    {
        $categories = SermonCategory::orderBy('name')->get();
        return view('admin.sermons.edit', compact('sermon', 'categories'));
    }

    public function update(SermonRequest $request, Sermon $sermon)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $this->mediaService->deleteFile($sermon->thumbnail);
            $paths = $this->mediaService->uploadImage($request->file('thumbnail'), 'sermons/thumbnails', true, ['thumb' => [300, 200]]);
            $data['thumbnail'] = $paths['original'];
        }

        if ($request->hasFile('document')) {
            $this->mediaService->deleteFile($sermon->document_url);
            $data['document_url'] = $this->mediaService->uploadDocument($request->file('document'), 'sermons/documents');
        }

        $this->sermonService->updateSermon($sermon, $data);

        activity()->performedOn($sermon)->log('Updated sermon: ' . $sermon->title);

        return redirect()->route('admin.sermons.index')
            ->with('success', 'Sermon updated successfully.');
    }

    public function destroy(Sermon $sermon)
    {
        $title = $sermon->title;
        $sermon->delete();

        activity()->log("Deleted sermon: {$title}");

        return redirect()->route('admin.sermons.index')
            ->with('success', 'Sermon deleted successfully.');
    }

    public function toggleFeatured(Sermon $sermon)
    {
        $sermon->update(['is_featured' => !$sermon->is_featured]);
        return back()->with('success', 'Sermon updated.');
    }
}
