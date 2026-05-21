<?php

namespace App\Services;

use App\Models\Sermon;
use App\Models\SermonCategory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SermonService
{
    public function getPublishedSermons(array $filters = [], int $perPage = 12): LengthAwarePaginator
    {
        $query = Sermon::published()
            ->with(['category', 'author'])
            ->orderByDesc('preached_date');

        if (!empty($filters['category'])) {
            $query->whereHas('category', fn($q) => $q->where('slug', $filters['category']));
        }

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', "%{$filters['search']}%")
                  ->orWhere('speaker', 'like', "%{$filters['search']}%")
                  ->orWhere('scripture_reference', 'like', "%{$filters['search']}%")
                  ->orWhere('description', 'like', "%{$filters['search']}%");
            });
        }

        if (!empty($filters['speaker'])) {
            $query->where('speaker', 'like', "%{$filters['speaker']}%");
        }

        if (!empty($filters['year'])) {
            $query->whereYear('preached_date', $filters['year']);
        }

        if (!empty($filters['language'])) {
            $query->where('language', $filters['language']);
        }

        return $query->paginate($perPage);
    }

    public function getFeaturedSermons(int $limit = 3): Collection
    {
        return Cache::remember('featured_sermons', 3600, function () use ($limit) {
            return Sermon::published()->featured()
                ->with(['category'])
                ->orderByDesc('preached_date')
                ->limit($limit)
                ->get();
        });
    }

    public function getLatestSermons(int $limit = 6): Collection
    {
        return Cache::remember('latest_sermons', 1800, function () use ($limit) {
            return Sermon::published()
                ->with(['category'])
                ->orderByDesc('preached_date')
                ->limit($limit)
                ->get();
        });
    }

    public function getRelatedSermons(Sermon $sermon, int $limit = 4): Collection
    {
        return Sermon::published()
            ->where('id', '!=', $sermon->id)
            ->where(function ($q) use ($sermon) {
                $q->where('category_id', $sermon->category_id)
                  ->orWhere('speaker', $sermon->speaker);
            })
            ->orderByDesc('preached_date')
            ->limit($limit)
            ->get();
    }

    public function getAllCategories(): Collection
    {
        return Cache::remember('sermon_categories', 3600, function () {
            return SermonCategory::withCount(['sermons' => fn($q) => $q->published()])
                ->orderBy('order')
                ->get();
        });
    }

    public function getSpeakers(): Collection
    {
        return Cache::remember('sermon_speakers', 3600, function () {
            return Sermon::published()
                ->whereNotNull('speaker')
                ->distinct()
                ->pluck('speaker')
                ->sort()
                ->values();
        });
    }

    public function createSermon(array $data, $user): Sermon
    {
        $data['author_id'] = $user->id;

        if (isset($data['video_url'])) {
            $data['video_embed_id'] = $this->extractVideoId($data['video_url'], $data['video_type'] ?? 'youtube');
        }

        if (isset($data['published_at']) && $data['status'] === 'published') {
            $data['published_at'] = $data['published_at'] ?? now();
        }

        $sermon = Sermon::create($data);
        $this->clearCache();

        return $sermon;
    }

    public function updateSermon(Sermon $sermon, array $data): Sermon
    {
        if (isset($data['video_url'])) {
            $data['video_embed_id'] = $this->extractVideoId($data['video_url'], $data['video_type'] ?? $sermon->video_type);
        }

        $sermon->update($data);
        $this->clearCache();

        return $sermon;
    }

    private function extractVideoId(string $url, string $type): string
    {
        return match($type) {
            'youtube' => $this->extractYouTubeId($url),
            'vimeo' => $this->extractVimeoId($url),
            default => $url,
        };
    }

    private function extractYouTubeId(string $url): string
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches);
        return $matches[1] ?? $url;
    }

    private function extractVimeoId(string $url): string
    {
        preg_match('/vimeo\.com\/(?:video\/)?(\d+)/i', $url, $matches);
        return $matches[1] ?? $url;
    }

    private function clearCache(): void
    {
        Cache::forget('featured_sermons');
        Cache::forget('latest_sermons');
        Cache::forget('sermon_speakers');
        Cache::forget('sermon_categories');
    }
}
