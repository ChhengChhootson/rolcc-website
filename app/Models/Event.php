<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Event extends Model
{
    use HasFactory, SoftDeletes, HasSlug, LogsActivity;

    protected $fillable = [
        'title', 'title_km', 'slug', 'short_description', 'description', 'description_km',
        'featured_image', 'banner_image', 'event_type', 'start_date', 'end_date',
        'location', 'address', 'latitude', 'longitude', 'maps_url',
        'is_online', 'online_link', 'requires_registration', 'max_attendees',
        'ticket_price', 'contact_email', 'contact_phone', 'organizer_id',
        'status', 'is_featured', 'is_recurring', 'recurrence_rule',
        'tags', 'published_at',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'is_online' => 'boolean',
            'requires_registration' => 'boolean',
            'is_featured' => 'boolean',
            'is_recurring' => 'boolean',
            'ticket_price' => 'decimal:2',
            'tags' => 'array',
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

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function confirmedRegistrations()
    {
        return $this->hasMany(EventRegistration::class)->where('status', 'confirmed');
    }

    public function getFeaturedImageUrlAttribute(): string
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        return asset('images/event-default.jpg');
    }

    public function isFree(): bool
    {
        return $this->ticket_price == 0;
    }

    public function isFull(): bool
    {
        if (!$this->max_attendees) return false;
        return $this->confirmedRegistrations()->sum('attendees_count') >= $this->max_attendees;
    }

    public function getAvailableSpotsAttribute(): ?int
    {
        if (!$this->max_attendees) return null;
        $taken = $this->confirmedRegistrations()->sum('attendees_count');
        return max(0, $this->max_attendees - $taken);
    }

    public function isUpcoming(): bool
    {
        return $this->start_date->isFuture();
    }

    public function isPast(): bool
    {
        return $this->end_date->isPast();
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now())->orderBy('start_date');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
