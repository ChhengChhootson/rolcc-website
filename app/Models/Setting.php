<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key', 'value', 'type', 'group', 'label', 'description', 'is_public', 'order',
    ];

    protected function casts(): array
    {
        return [
            'is_public' => 'boolean',
        ];
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->getParsedValue() : $default;
        });
    }

    public static function set(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => is_array($value) ? json_encode($value) : $value]);
        Cache::forget("setting_{$key}");
        Cache::forget('all_settings');
    }

    public static function getGroup(string $group): array
    {
        return Cache::remember("settings_group_{$group}", 3600, function () use ($group) {
            return static::where('group', $group)->get()
                ->mapWithKeys(fn($s) => [$s->key => $s->getParsedValue()])
                ->toArray();
        });
    }

    public function getParsedValue(): mixed
    {
        return match ($this->type) {
            'boolean' => filter_var($this->value, FILTER_VALIDATE_BOOLEAN),
            'integer' => (int) $this->value,
            'json' => json_decode($this->value, true),
            default => $this->value,
        };
    }

    protected static function booted(): void
    {
        static::saved(function (self $setting) {
            Cache::forget("setting_{$setting->key}");
            Cache::forget("settings_group_{$setting->group}");
            Cache::forget('all_settings');
        });
    }
}
