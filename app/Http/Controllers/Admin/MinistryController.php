<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ministry;
use App\Models\MinistryLeader;
use App\Services\MediaService;
use App\Http\Requests\Admin\MinistryRequest;
use Illuminate\Http\Request;

class MinistryController extends Controller
{
    public function __construct(private MediaService $mediaService) {}

    public function index()
    {
        $ministries = Ministry::withCount('leaders')
            ->orderBy('order')
            ->paginate(20);

        return view('admin.ministries.index', compact('ministries'));
    }

    public function create()
    {
        return view('admin.ministries.create');
    }

    public function store(MinistryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('featured_image')) {
            $paths = $this->mediaService->uploadImage($request->file('featured_image'), 'ministries', true, ['thumb' => [400, 250]]);
            $data['featured_image'] = $paths['original'];
        }

        $ministry = Ministry::create($data);

        // Handle leaders
        if ($request->has('leaders')) {
            foreach ($request->input('leaders', []) as $index => $leaderData) {
                $photo = null;
                if (isset($leaderData['photo']) && $leaderData['photo'] instanceof \Illuminate\Http\UploadedFile) {
                    $paths = $this->mediaService->uploadImage($leaderData['photo'], 'ministries/leaders', true, ['thumb' => [200, 200]]);
                    $photo = $paths['original'];
                }

                $ministry->leaders()->create(array_merge($leaderData, ['photo' => $photo, 'order' => $index]));
            }
        }

        return redirect()->route('admin.ministries.index')
            ->with('success', 'Ministry created successfully.');
    }

    public function edit(Ministry $ministry)
    {
        $ministry->load('leaders');
        return view('admin.ministries.edit', compact('ministry'));
    }

    public function update(MinistryRequest $request, Ministry $ministry)
    {
        $data = $request->validated();

        if ($request->hasFile('featured_image')) {
            $this->mediaService->deleteFile($ministry->featured_image);
            $paths = $this->mediaService->uploadImage($request->file('featured_image'), 'ministries', true, ['thumb' => [400, 250]]);
            $data['featured_image'] = $paths['original'];
        }

        $ministry->update($data);

        return redirect()->route('admin.ministries.index')
            ->with('success', 'Ministry updated successfully.');
    }

    public function destroy(Ministry $ministry)
    {
        $ministry->delete();
        return redirect()->route('admin.ministries.index')->with('success', 'Ministry deleted.');
    }

    public function reorder(Request $request)
    {
        foreach ($request->input('order', []) as $item) {
            Ministry::where('id', $item['id'])->update(['order' => $item['order']]);
        }
        return response()->json(['success' => true]);
    }
}
