<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livestream extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'platform', 'stream_id', 'stream_url',
        'embed_code', 'thumbnail', 'is_live', 'is_scheduled',
        'scheduled_at', 'started_at', 'ended_at', 'viewer_count',
        'peak_viewers', 'status', 'archive_after', 'author_id',
    ];

    protected function casts(): array
    {
        return [
            'is_live' => 'boolean',
            'is_scheduled' => 'boolean',
            'archive_after' => 'boolean',
            'scheduled_at' => 'datetime',
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getEmbedUrlAttribute(): ?string
    {
        return match($this->platform) {
            'youtube' => "https://www.youtube.com/embed/{$this->stream_id}?autoplay=1",
            'facebook' => $this->stream_url,
            default => $this->stream_url,
        };
    }

    public function scopeLive($query)
    {
        return $query->where('is_live', true)->where('status', 'live');
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled')->where('scheduled_at', '>', now());
    }
}
