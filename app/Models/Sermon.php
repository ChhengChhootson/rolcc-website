<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Sermon extends Model
{
    use HasFactory, SoftDeletes, LogsActivity, HasSlug;

    protected $fillable = [
        'title', 'title_km', 'slug', 'description', 'description_km',
        'notes', 'scripture_reference', 'series_name', 'speaker',
        'category_id', 'author_id', 'video_type', 'video_url',
        'video_embed_id', 'audio_url', 'thumbnail', 'document_url',
        'duration_seconds', 'language', 'status', 'is_featured',
        'allow_download', 'tags', 'preached_date', 'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'allow_download' => 'boolean',
            'tags' => 'array',
            'preached_date' => 'date',
            'published_at' => 'datetime',
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->logOnlyDirty();
    }

    public function category()
    {
        return $this->belongsTo(SermonCategory::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        return asset('images/sermon-default.jpg');
    }

    public function getVideoEmbedUrlAttribute(): ?string
    {
        return match($this->video_type) {
            'youtube' => "https://www.youtube.com/embed/{$this->video_embed_id}",
            'facebook' => $this->video_url,
            'vimeo' => "https://player.vimeo.com/video/{$this->video_embed_id}",
            default => $this->video_url,
        };
    }

    public function getDurationFormattedAttribute(): string
    {
        if (!$this->duration_seconds) return '';
        $hours = floor($this->duration_seconds / 3600);
        $minutes = floor(($this->duration_seconds % 3600) / 60);
        $seconds = $this->duration_seconds % 60;
        return $hours > 0
            ? sprintf('%d:%02d:%02d', $hours, $minutes, $seconds)
            : sprintf('%d:%02d', $minutes, $seconds);
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where(fn($q) => $q->whereNull('published_at')->orWhere('published_at', '<=', now()));
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('preached_date', 'desc');
    }
}
