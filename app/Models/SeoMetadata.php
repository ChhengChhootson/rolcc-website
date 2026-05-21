<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMetadata extends Model
{
    protected $table = 'seo_metadata';

    protected $fillable = [
        'model_type', 'model_id', 'page_key', 'title', 'description',
        'keywords', 'og_title', 'og_description', 'og_image', 'og_type',
        'twitter_card', 'twitter_title', 'twitter_description', 'twitter_image',
        'canonical_url', 'robots', 'schema_markup',
    ];

    protected function casts(): array
    {
        return ['schema_markup' => 'array'];
    }

    public function model()
    {
        return $this->morphTo();
    }

    public static function forPage(string $key): ?self
    {
        return static::where('page_key', $key)->first();
    }
}
