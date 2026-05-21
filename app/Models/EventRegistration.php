<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id', 'user_id', 'first_name', 'last_name', 'email',
        'phone', 'attendees_count', 'status', 'ticket_number',
        'notes', 'payment_status', 'amount_paid', 'confirmed_at', 'checked_in_at',
    ];

    protected function casts(): array
    {
        return [
            'attendees_count' => 'integer',
            'amount_paid' => 'decimal:2',
            'confirmed_at' => 'datetime',
            'checked_in_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $registration) {
            if (!$registration->ticket_number) {
                $registration->ticket_number = 'ROLCC-' . strtoupper(Str::random(8));
            }
        });
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function confirm(): void
    {
        $this->update(['status' => 'confirmed', 'confirmed_at' => now()]);
    }

    public function checkIn(): void
    {
        $this->update(['status' => 'attended', 'checked_in_at' => now()]);
    }
}
