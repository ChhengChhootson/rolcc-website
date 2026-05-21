<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrayerRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'name', 'email', 'phone', 'subject', 'request',
        'category', 'is_anonymous', 'is_public', 'is_urgent',
        'status', 'admin_notes', 'response', 'assigned_to',
        'prayer_count', 'answered_at',
    ];

    protected function casts(): array
    {
        return [
            'is_anonymous' => 'boolean',
            'is_public' => 'boolean',
            'is_urgent' => 'boolean',
            'answered_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function getRequesterNameAttribute(): string
    {
        if ($this->is_anonymous) return 'Anonymous';
        return $this->name ?? ($this->user?->name ?? 'Unknown');
    }

    public function markAsAnswered(): void
    {
        $this->update(['status' => 'answered', 'answered_at' => now()]);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeUrgent($query)
    {
        return $query->where('is_urgent', true);
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', true)->where('is_anonymous', false);
    }
}
