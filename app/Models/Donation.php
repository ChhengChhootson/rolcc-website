<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Donation extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'user_id', 'category_id', 'donor_name', 'donor_email', 'donor_phone',
        'amount', 'currency', 'payment_method', 'transaction_id',
        'reference_number', 'message', 'status', 'is_anonymous',
        'is_recurring', 'recurrence_interval', 'receipt_path',
        'donated_at', 'meta',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'is_anonymous' => 'boolean',
            'is_recurring' => 'boolean',
            'donated_at' => 'datetime',
            'meta' => 'array',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['amount', 'status', 'payment_method'])->logOnlyDirty();
    }

    protected static function booted(): void
    {
        static::creating(function (self $donation) {
            if (!$donation->reference_number) {
                $donation->reference_number = 'DON-' . date('Y') . '-' . strtoupper(Str::random(8));
            }
            if (!$donation->donated_at) {
                $donation->donated_at = now();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(DonationCategory::class);
    }

    public function getDonorDisplayNameAttribute(): string
    {
        if ($this->is_anonymous) return 'Anonymous';
        return $this->donor_name ?? ($this->user?->name ?? 'Unknown');
    }

    public function getAmountFormattedAttribute(): string
    {
        return '$' . number_format($this->amount, 2);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('donated_at', now()->month)->whereYear('donated_at', now()->year);
    }
}
