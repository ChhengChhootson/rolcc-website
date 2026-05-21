<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonial extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'title', 'photo', 'content', 'content_km', 'video_url',
        'category', 'rating', 'is_featured', 'is_approved', 'status',
        'order', 'approved_by',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_approved' => 'boolean',
            'rating' => 'integer',
        ];
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=F8FAFC&background=145DA0';
    }

    public function approve(): void
    {
        $this->update(['status' => 'approved', 'is_approved' => true]);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved')->where('is_approved', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
