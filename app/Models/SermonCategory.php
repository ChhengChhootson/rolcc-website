<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class SermonCategory extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name', 'name_km', 'slug', 'description', 'color', 'icon', 'order',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function sermons()
    {
        return $this->hasMany(Sermon::class, 'category_id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }

    public function getPublishedSermonsCountAttribute(): int
    {
        return $this->sermons()->published()->count();
    }
}
