<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Album extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $fillable = [
        'title', 'title_km', 'slug', 'description', 'cover_image',
        'album_type', 'event_name', 'event_date', 'author_id',
        'status', 'is_featured', 'order', 'published_at',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'is_featured' => 'boolean',
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

    public function media()
    {
        return $this->hasMany(Gallery::class)->orderBy('order');
    }

    public function photos()
    {
        return $this->hasMany(Gallery::class)->where('file_type', 'image')->orderBy('order');
    }

    public function videos()
    {
        return $this->hasMany(Gallery::class)->where('file_type', 'video')->orderBy('order');
    }

    public function getCoverImageUrlAttribute(): string
    {
        if ($this->cover_image) {
            return asset('storage/' . $this->cover_image);
        }
        return $this->media()->first()?->getThumbnailUrlAttribute() ?? asset('images/album-default.jpg');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
