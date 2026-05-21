<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $fillable = [
        'title', 'slug', 'content', 'content_km', 'template',
        'status', 'featured_image', 'sections', 'meta',
        'is_system_page', 'author_id', 'published_at', 'order',
    ];

    protected function casts(): array
    {
        return [
            'sections' => 'array',
            'meta' => 'array',
            'is_system_page' => 'boolean',
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

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function seo()
    {
        return $this->morphOne(SeoMetadata::class, 'model');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
