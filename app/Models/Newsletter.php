<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'name', 'phone', 'preferred_language', 'is_subscribed',
        'token', 'source', 'subscribed_at', 'unsubscribed_at',
        'unsubscribe_reason', 'preferences',
    ];

    protected function casts(): array
    {
        return [
            'is_subscribed' => 'boolean',
            'subscribed_at' => 'datetime',
            'unsubscribed_at' => 'datetime',
            'preferences' => 'array',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $newsletter) {
            if (!$newsletter->token) {
                $newsletter->token = Str::random(32);
            }
            if (!$newsletter->subscribed_at) {
                $newsletter->subscribed_at = now();
            }
        });
    }

    public function unsubscribe(string $reason = null): void
    {
        $this->update([
            'is_subscribed' => false,
            'unsubscribed_at' => now(),
            'unsubscribe_reason' => $reason,
        ]);
    }

    public function scopeSubscribed($query)
    {
        return $query->where('is_subscribed', true);
    }
}
