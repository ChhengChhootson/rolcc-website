<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use App\Services\SermonService;
use Illuminate\Http\Request;

class SermonController extends Controller
{
    public function __construct(private SermonService $sermonService) {}

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category', 'speaker', 'year', 'language']);
        $sermons = $this->sermonService->getPublishedSermons($filters, 12);
        $categories = $this->sermonService->getAllCategories();
        $speakers = $this->sermonService->getSpeakers();
        $years = Sermon::published()->selectRaw('YEAR(preached_date) as year')
            ->groupBy('year')->orderByDesc('year')->pluck('year');

        return view('public.sermons.index', compact('sermons', 'categories', 'speakers', 'years', 'filters'));
    }

    public function show(string $slug)
    {
        $sermon = Sermon::published()
            ->with(['category', 'author'])
            ->where('slug', $slug)
            ->firstOrFail();

        $sermon->incrementViews();

        $related = $this->sermonService->getRelatedSermons($sermon, 4);
        $categories = $this->sermonService->getAllCategories();

        return view('public.sermons.show', compact('sermon', 'related', 'categories'));
    }

    public function download(string $slug)
    {
        $sermon = Sermon::published()
            ->where('slug', $slug)
            ->where('allow_download', true)
            ->whereNotNull('document_url')
            ->firstOrFail();

        $sermon->increment('downloads');
        $path = storage_path('app/public/' . $sermon->document_url);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path, $sermon->title . '.pdf');
    }
}
