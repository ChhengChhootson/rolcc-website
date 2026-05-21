<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Ministry extends Model
{
    use HasFactory, SoftDeletes, HasSlug, LogsActivity;

    protected $fillable = [
        'name', 'name_km', 'slug', 'short_description', 'short_description_km',
        'description', 'description_km', 'icon', 'color', 'featured_image',
        'banner_image', 'schedule', 'meeting_location', 'contact_email',
        'contact_phone', 'age_group', 'is_active', 'is_featured', 'order', 'status',
    ];

    protected function casts(): array
    {
        return [
            'schedule' => 'array',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->logOnlyDirty();
    }

    public function leaders()
    {
        return $this->hasMany(MinistryLeader::class)->orderBy('order');
    }

    public function primaryLeader()
    {
        return $this->hasOne(MinistryLeader::class)->where('is_primary', true);
    }

    public function gallery()
    {
        return $this->morphMany(MediaFile::class, 'model')->where('collection', 'gallery');
    }

    public function getFeaturedImageUrlAttribute(): string
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        return asset('images/ministry-default.jpg');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
