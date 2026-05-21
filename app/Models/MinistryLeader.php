<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinistryLeader extends Model
{
    use HasFactory;

    protected $fillable = [
        'ministry_id', 'name', 'title', 'photo', 'bio',
        'email', 'phone', 'is_primary', 'order',
    ];

    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
        ];
    }

    public function ministry()
    {
        return $this->belongsTo(Ministry::class);
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=F8FAFC&background=145DA0&size=150';
    }
}
